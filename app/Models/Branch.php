<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'status',
        'city_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_branches', 'branch_id', 'user_id', 'id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'order_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
            'code',
            'status',
            'city_id',
        ]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
            'city_id' => null
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('status', $filters['status'])
                ->orWhere('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('code', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] != '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->where('status', $filters['status'])
                ->orWhere('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('code', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->where('status', $filters['status']);
        });

        $builder->when($filters['city_id'] != null, function ($query) use ($filters) {
            $query->whereIn('city_id', $filters['city_id']);
        });
    }

    public function getUsersCountAttribute()
    {
        return $this->users()->count();
    }

    public function getCityNameAttribute()
    {
        $city = $this->city()->first();
        return $city ? $city->name : 'غير محدد';
    }

    public function scopeGetRules(Builder $builder, $id)
    {
        return [
            "name" => ["required", "unique:branches,name,$id"],
            "code" => ["required", "unique:branches,code,$id"],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "name.required" => "اسم الفرع مطلوب",
            // "name.string" => "اسم الفرع يجب ان يكون نص",
            "name.unique" => "اسم الفرع موجود بالفعل",
            "code.required" => "كود الفرع مطلوب",
            // "code.string" => "كود الفرع يجب ان يكون نص",
            "code.unique" => "كود الفرع موجود بالفعل",
        ];
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $branch = $builder->find($id);
        if ($branch) {
            $branch->delete();
            return "تم حذف الفرع بنجاح";
        }

        return false;
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $branch = $builder->find($id);
        if ($branch) {
            $branch->update([
                'status' => $branch->status == 1 ? 2 : 1
            ]);
            return "تم تغيير حالة الفرع بنجاح";
        }

        return true;
    }

    public function scopeStore(Builder $builder, array $data = [])
    {
        $user = auth()->user();
        $data["user_id"] = $user->id;
        $data["creator"] = $user->id;

        $branch = $builder->create($data);

        if ($branch) {
            return "تم اضافة الفرع بنجاح";
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $user = auth()->user();
        $data['updater'] = $user->id;

        $branch = $builder->find($id);

        if ($branch) {
            $branch->update($data);
            return "تم تعديل الوسيط بنجاح";
        }

        return false;
    }
}
