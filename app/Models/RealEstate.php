<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "floor",
        "floors",
        "flats",
        "flat_rooms",
        "rooms",
        "stores",
        "bathrooms",
        "interface_length",
        "age",
        "space",
        "annual_income",
        "total",
        "price",
        "price_meter",
        "notes",
        "land_number",
        "statement",
        "character",
        "block_number",
        "real_estate_type",
        "property_status",
        "creator",
        "updater"
    ];

    public function scopeData($query)
    {
        return $query->select([
            "id",
            "user_id",
            "floor",
            "floors",
            "flats",
            "flat_rooms",
            "rooms",
            "stores",
            "bathrooms",
            "interface_length",
            "age",
            "space",
            "annual_income",
            "total",
            "price",
            "price_meter",
            "notes",
            "land_number",
            "statement",
            "character",
            "block_number",
            "real_estate_type",
            "property_status",
            "creator",
            "updater"
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function location()
    {
        return $this->hasOne(RealEstateLocation::class, 'real_estate_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'real_estate_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'real_estate_id', 'id');
    }

    public function scopeStore(Builder $builder,  $data)
    {
        $data['real_estate_type'] = $data["property_type"];
        $data['property_status'] = "vacant";
        $real_estate = $builder->create($data);
        $data['real_estate_id'] = $real_estate->id;
        RealEstateLocation::store($data);

        return $real_estate;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $dat = [];
        foreach ($this->fillable as $field) {

            if (array_key_exists($field, $data)) {
                $dat[$field] = $data[$field];
            }
        }

        $real_estate = $builder->find($id);

        $real_estate->update($dat);

        $real_estate_location_id = $real_estate->location->id;

        RealEstateLocation::updateModel($data, $real_estate_location_id);
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $real_estate = $builder->find($id);

        if ($real_estate) {
            $real_estate->delete();
            return "تم حذف العقار بنجاح";
        }

        return false;
    }
}
