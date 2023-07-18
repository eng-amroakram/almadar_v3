<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'status',
        "creator",
        "updater",
    ];

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class, 'city_id', 'id');
    }

    public function realEstateLocations()
    {
        return $this->hasMany(RealEstateLocation::class, 'city_id', 'id');
    }

    public function branches()
    {
        return $this->hasMany(Branch::class, 'city_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
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
            'code',
            'status',
            "creator",
            "updater",
        ]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
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
            $query->whereIn('status', $filters['status']);
        });
    }

    public function scopeGetRules(Builder $builder, $id)
    {
        return [
            "name" => ["required", "string", "unique:cities,name,$id"],
            "code" => ["required", "string", "unique:cities,code,$id"],
            "status" => ["required", "in:1,2"]
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "name.required" => "هذا الحقل مطلوب",
            "name.unique" => "المدينة موجودة !!",

            "code.required" => "هذا الحقل مطلوب",
            "code.unique" => "الكود موجود !!",

            "status.required" => "هذا الحقل مطلوب",
            "status.in" => "حدث خطأ ما !!",
        ];
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $broker = $builder->find($id);
        if ($broker) {
            $broker->delete();
            return "تم حذف المدينة بنجاح";
        }

        return false;
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $city = $builder->find($id);
        if ($city) {
            $city->update([
                'status' => $city->status == 1 ? 2 : 1
            ]);
            return "تم تغير حالة المدينة بنجاح";
        }

        return true;
    }

    public function scopeStore(Builder $builder, $data)
    {
        $user = auth()->user();
        $data["user_id"] = $user->id;
        $data["creator"] = $user->id;

        $city = $builder->create($data);

        if ($city) {
            return "تم إضافة المدينة بنجاح";
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $city = $builder->find($id);
        if ($city) {
            $user = auth()->user();
            $data["user_id"] = $user->id;
            $data["updater"] = $user->id;

            $city->update($data);
            return "تم تعديل المدينة بنجاح";
        }

        return false;
    }
}
