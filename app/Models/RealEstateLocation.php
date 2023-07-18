<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstateLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "real_estate_id",
        "city_id",
        "neighborhood_id",
        "land_type",
        "owner_ship_type",
        "building_type",
        "building_status",
        "construction_delivery",
        "property_type",
        "street_width",
        "licensed",
        "directions",
        "branch_id",
    ];

    public function scopeData($query)
    {
        return $query->select([
            "id",
            "user_id",
            "real_estate_id",
            "city_id",
            "neighborhood_id",
            "land_type",
            "owner_ship_type",
            "building_type",
            "building_status",
            "construction_delivery",
            "property_type",
            "street_width",
            "licensed",
            "directions",
            "branch_id",
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class, 'real_estate_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
    }

    public function scopeStore(Builder $builder, $data)
    {
        $builder->create($data);
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $dat = [];
        foreach ($this->fillable as $field) {

            if (array_key_exists($field, $data)) {
                $dat[$field] = $data[$field];
            }
        }

        $real_estate_location = $builder->find($id);

        $real_estate_location->update($dat);
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $real_estate_location = $builder->find($id)->first();

        if ($real_estate_location) {
            $real_estate_location->delete();
            return "تم حذف العقار بنجاح";
        }

        return false;
    }
}
