<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'city_id',
        "creator",
        "updater"
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_branches', 'branch_id', 'user_id', 'id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function realEstateLocations()
    {
        return $this->hasMany(RealEstateLocation::class, 'city_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'neighborhood_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
            'status',
            'city_id',
            "creator",
            "updater"
        ]);
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'];
    }

    public function getCityNameAttribute()
    {
        $city = $this->city;
        if ($city) {
            return $city->name;
        }

        return "None";
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
                ->orWhere('name', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] != '' && ($filters['status'] != null ||  $filters['city_id'] != null), function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->whereIn('status', $filters['status'])
                ->whereIn('city_id', $filters['city_id']);
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });

        $builder->when($filters['search'] == '' && $filters['city_id'] != null, function ($query) use ($filters) {
            $query->whereIn('city_id', $filters['city_id']);
        });
    }

    public function scopeGetRules(Builder $builder, $id)
    {
        return [
            "name" => ["required", "string", "unique:neighborhoods,name,$id"],
            "city_id" => ["required", "exists:cities,id"],
            "status" => ["required", "in:1,2"]
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "name.required" => "هذا الحقل مطلوب",
            "name.unique" => "الحي موجود !!",

            "city_id.required" => "هذا الحقل مطلوب",
            "city_id.exists" => "يرجى اختيار المدينة !",

            "status.required" => "هذا الحقل مطلوب",
            "status.in" => "حدث خطأ ما !!",
        ];
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $neighborhood = $builder->find($id);
        if ($neighborhood) {
            $neighborhood->delete();
            return "تم حذف الحي بنجاح";
        }

        return false;
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $neighborhood = $builder->find($id);
        if ($neighborhood) {
            $neighborhood->update([
                'status' => $neighborhood->status == 1 ? 2 : 1
            ]);
            return "تم تغير حالة الحي بنجاح";
        }

        return true;
    }

    public function scopeStore(Builder $builder, $data)
    {
        $user = auth()->user();
        $data["user_id"] = $user->id;
        $data["creator"] = $user->id;
        $neighborhood = $builder->create($data);

        if ($neighborhood) {
            return "تم إضافة الحي بنجاح";
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $neighborhood = $builder->find($id);
        if ($neighborhood) {
            $user = auth()->user();
            $data["user_id"] = $user->id;
            $data["updater"] = $user->id;

            $neighborhood->update($data);
            return "تم تعديل الحي بنجاح";
        }

        return false;
    }
}




