<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'user_status',
        'user_type',
        'verification_code',
        'email_verified_at',
        'advertiser_number',
        'permissions'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'permissions' => 'json'
    ];

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'users_branches', 'user_id', 'branch_id', 'id', 'id');
    }

    public function salePayments()
    {
        return $this->hasMany(SalePayment::class, 'user_id', 'id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'user_id', 'id');
    }

    public function brokers()
    {
        return $this->hasMany(Broker::class, 'user_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
            'email',
            'password',
            'phone',
            'user_status',
            'user_type',
            'advertiser_number',
            'permissions'
        ]);
    }

    //Attributes
    public function getUserTypeAttribute()
    {
        return $this->attributes['user_type'];
    }

    public function getBranchesAttribute()
    {
        return $this->branches()->get()->toArray();
    }

    public function getTypeAttribute()
    {
        if ($this->attributes['user_type'] == 'superadmin') {
            return "ادمن رئيسي";
        }

        if ($this->attributes['user_type'] == 'admin') {
            return "ادمن فرعي";
        }

        if ($this->attributes['user_type'] == 'office') {
            return "مكتب";
        }

        if ($this->attributes['user_type'] == 'marketer') {
            return "مسوق";
        }
        return $this->attributes['user_type'];
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'user_status' => null,
            'user_type' => null,
            'branch_id' => null
        ], $filters);


        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('phone', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['user_type'] != null, function ($query) use ($filters) {
            $query->whereIn('user_type', $filters['user_type']);
        });

        $builder->when($filters['search'] == '' && $filters['user_status'] != null, function ($query) use ($filters) {
            $query->whereIn('user_status', $filters['user_status']);
        });

        $builder->when($filters['search'] == '' && $filters['branch_id'] != null, function ($query) use ($filters) {
            $query->whereHas('branches', function ($query) use ($filters) {
                $query->whereIn('id', $filters['branch_id']);
            });
        });
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,$id"],
            'phone' => ['required', 'string', "unique:users,phone,$id"],
            "password" => ['required', 'string', 'min:8'],
            'user_status' => ['required', 'string', 'in:active,inactive'],
            'user_type' => ['required', 'string', 'in:admin,office,marketer'],
            'advertiser_number' => ['nullable', 'string'],
            'branches_ids' => ['required', 'array'],
            'permissions' => ['required', 'array'],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "name.required" => "حقل الاسم مطلوب",
            "email.required" => "حقل البريد الإلكتروني مطلوب",
            "email.email" => "البريد الإلكتروني يجب أن يكون صحيح",
            "email.unique" => "البريد الإلكتروني مستخدم من قبل",
            "phone.required" => "رقم الجوال مطلوب",
            "phone.unique" => "رقم الجوال مستخدم من قبل",
            "password.required" => "حقل كلمة المرور مطلوب",
            "password.min" => "حقل كلمة المرور يجب أن لا يقل عن 8 أحرف",
            "user_status.required" => "حقل حالة المستخدم مطلوب",
            "user_type.required" => "حقل نوع المستخدم مطلوب",
            "branches_ids.required" => "حقل الفروع مطلوب",
            "branches_ids.array" => "حقل الفروع يجب أن يكون مصفوفة",
        ];
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $user = $builder->find($id);
        if ($user) {
            $user->delete();
            return "تم حذف المستخدم بنجاح";
        }

        return false;
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $user = $builder->find($id);
        if ($user) {
            $user->update([
                'user_status' => $user->user_status == 'active' ? 'inactive' : 'active'
            ]);
            return "تم تغير حالة المستخدم بنجاح";
        }

        return true;
    }

    public function scopeStore(Builder $builder, array $data = [])
    {
        $data["user_id"] = auth()->id();
        $data["creator"] = auth()->id();

        $permissions = $data['permissions'];
        $all_permissions = config('permissions.all');

        $perms = [];

        foreach ($all_permissions as $key => $value) {
            if (in_array($key, $permissions)) {
                $perms[$key] = true;
            } else {
                $perms[$key] = false;
            }
        }

        $data['permissions'] = $perms;

        $user = $builder->create($data);

        $user->branches()->sync($data['branches_ids']);

        if ($user) {
            return "تم إضافة المستخدم بنجاح";
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $data['updater'] = auth()->id();

        $user = $builder->find($id);

        $permissions = $data['permissions'];
        $all_permissions = config('permissions.all');

        $perms = [];

        foreach ($all_permissions as $key => $value) {
            if (in_array($key, $permissions)) {
                $perms[$key] = true;
            } else {
                $perms[$key] = false;
            }
        }

        $data['permissions'] = $perms;

        if ($user) {
            $user->update($data);
            $user->branches()->sync($data['branches_ids']);
            return "تم تعديل المستخدم بنجاح";
        }

        return false;
    }
}
