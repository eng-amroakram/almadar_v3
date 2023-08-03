<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id",
        "real_estate_id",
        "user_id",
        "brokers_ids",
        "offer_code",
        "offer_type",
        "status",
        "creator",
        "updater"
    ];

    public function scopeData($query)
    {
        return $query->select([
            "id",
            "order_id",
            "real_estate_id",
            "user_id",
            "brokers_ids",
            "offer_code",
            "offer_type",
            "status",
            "creator",
            "updater"
        ]);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'order_id', 'id');
    }

    public function sale()
    {
        return $this->hasOne(Sale::class, 'offer_id', 'id');
    }

    public function broker()
    {
        return $this->hasOne(Broker::class, 'broker_id', 'id');
    }

    public function realEstate()
    {
        return $this->hasOne(RealEstate::class, 'id', 'real_estate_id');
    }

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'offer_id', 'id');
    }

    public function salePayment()
    {
        return $this->hasOne(SalePayment::class, 'offer_id', 'id');
    }

    public function offerEdits()
    {
        return $this->hasMany(OfferEditor::class, 'offer_id', 'id');
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'city_id' => null,
            'neighborhood_id' => null,
            'status' => null,
            'property_type' => null,
            "real_estate_status" => null,
            "branch_id" => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('offer_code', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });

        $builder->when($filters['search'] == '' && $filters['real_estate_status'] != null, function ($query) use ($filters) {
            $query->whereHas('realEstate', function ($query) use ($filters) {
                $query->whereIn('property_status', $filters['real_estate_status']);
            });
        });

        $builder->when($filters['search'] == '' && $filters['city_id'] != null, function ($query) use ($filters) {
            $query->whereHas('realEstate', function ($query) use ($filters) {
                $query->whereHas('location', function ($query) use ($filters) {
                    $query->whereIn('city_id', $filters['city_id']);
                });
            });
        });

        $builder->when($filters['search'] == '' && $filters['neighborhood_id'] != null, function ($query) use ($filters) {
            $query->whereHas('realEstate', function ($query) use ($filters) {
                $query->whereHas('location', function ($query) use ($filters) {
                    $query->whereIn('neighborhood_id', $filters['neighborhood_id']);
                });
            });
        });

        $builder->when($filters['search'] == '' && $filters['branch_id'] != null, function ($query) use ($filters) {
            $query->whereHas('realEstate', function ($query) use ($filters) {
                $query->whereHas('location', function ($query) use ($filters) {
                    $query->whereIn('branch_id', $filters['branch_id']);
                });
            });
        });
    }

    public function getOfferTypeNameAttribute()
    {
        return __($this->offer_type);
    }

    public function getIsDeservedAmountAttribute()
    {
        $total = (float)$this->total;

        if ($total > 1000000) {
            return true;
        }

        return false;
    }

    public function getDeservedAmountAttribute()
    {
        $total = (float)$this->total;

        if ($total > 1000000) {
            return $total - 1000000;
        }

        return 0.0;
    }

    public function getDeservedAmountPercentageAttribute()
    {
        $total = (float)$this->total;

        if ($total > 1000000) {
            return ($total - 1000000) * 0.05;
        }

        return 0.0;
    }

    public function getCityIdAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                if ($this->realEstate->location->city) {
                    return $this->realEstate->location->city->id;
                }
            }
        }

        return "null";
    }

    public function getOwnerShipTypeAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                if ($this->realEstate->location->city) {
                    return $this->realEstate->location->owner_ship_type;
                }
            }
        }

        return "null";
    }

    public function getNeighborhoodIdAttribute()
    {
        return $this->realEstate->location->neighborhood->id;
    }

    public function getBlockNumberAttribute()
    {
        return $this->realEstate->block_number;
    }

    public function getLandNumberAttribute()
    {
        return $this->realEstate->land_number;
    }

    public function getStatementAttribute()
    {
        return $this->realEstate->statement;
    }

    public function getPropertyTypeAttribute()
    {
        return $this->realEstate->real_estate_type;
    }

    public function getTotalAttribute()
    {
        return $this->realEstate->total;
    }

    public function getTotalStringAttribute()
    {
        return number_format($this->realEstate->total);
    }

    public function getFlatRoomsAttribute()
    {
        return $this->realEstate->flat_rooms;
    }

    public function getAgeAttribute()
    {
        return $this->realEstate->age;
    }

    public function getFloorsAttribute()
    {
        return $this->realEstate->floors;
    }

    public function getFloorAttribute()
    {
        return $this->realEstate->floor;
    }

    public function getFlatsAttribute()
    {
        return $this->realEstate->flats;
    }

    public function getStoresAttribute()
    {
        return $this->realEstate->stores;
    }

    public function getAnnualIncomeAttribute()
    {
        return $this->realEstate->annual_income;
    }

    public function getRealEstateTypeNameAttribute()
    {
        return __($this->realEstate->real_estate_type);
    }

    public function getNotesAttribute()
    {
        return $this->realEstate->notes;
    }

    public function getBranchIdAttribute()
    {
        return $this->realEstate->location->branch_id;
    }

    public function getBranchCodeAttribute()
    {
        return $this->realEstate->location->branch->code;
    }

    public function getPriceMeterAttribute()
    {
        return $this->realEstate->price_meter;
    }

    public function getPriceAttribute()
    {
        return $this->realEstate->price;
    }

    public function getBathroomsAttribute()
    {
        return $this->realEstate->bathrooms;
    }

    public function getCharacterAttribute()
    {
        return $this->realEstate->character;
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getCityNameAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                if ($this->realEstate->location->city) {
                    return $this->realEstate->location->city->name;
                }
            }
        }

        return "null";
    }

    public function getNeighborhoodNameAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                if ($this->realEstate->location->neighborhood) {
                    return $this->realEstate->location->neighborhood->name;
                }
            }
        }
        return "null";
    }

    public function getLandTypeAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                return $this->realEstate->location->land_type;
            }
        }
        return "null";
    }

    public function getBuildingTypeAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                return $this->realEstate->location->building_type;
            }
        }
        return "null";
    }

    public function getBuildingStatusAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                return $this->realEstate->location->building_status;
            }
        }
        return "null";
    }

    public function getConstructionDeliveryAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                return $this->realEstate->location->construction_delivery;
            }
        }
        return "null";
    }

    public function getDirectionsAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                return $this->realEstate->location->directions;
            }
        }
        return [];
    }

    public function getStreetWidthAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                return $this->realEstate->location->street_width;
            }
        }
        return [];
    }

    public function getLicensedAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                return $this->realEstate->location->licensed;
            }
        }
        return "null";
    }

    public function getSpaceAttribute()
    {
        return $this->realEstate->space;
    }

    public function getSpaceStringAttribute()
    {
        return number_format($this->realEstate->space);
    }

    public function getBrokersAttribute()
    {
        $brokers = Broker::whereIn('id', json_decode($this->brokers_ids) ?? [])->get();
        return $brokers;
    }

    public function getInterfaceLengthAttribute()
    {
        return $this->realEstate->interface_length;
    }

    public function getBranchNameAttribute()
    {
        if ($this->realEstate) {
            if ($this->realEstate->location) {
                if ($this->realEstate->location->branch) {
                    return $this->realEstate->location->branch->name;
                }
            }
        }
        return "null";
    }

    public function getRealEstateStatusNameAttribute()
    {
        return __($this->realEstate->property_status);
    }

    public function getOfferStatusAttribute()
    {
        return $this->status  == 1 ? "نشط" : "غير نشط";
    }

    public function scopeStore(Builder $builder, $data)
    {
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $data['creator'] = $user->id;
        $data['status'] = 1;

        if (array_key_exists('directions', $data)) {
            $data['directions'] = json_encode($data['directions']);
        }

        if (array_key_exists('street_width', $data)) {
            $data['street_width'] = json_encode($data['street_width']);
        }

        if (array_key_exists('brokers_ids', $data)) {
            $data['brokers_ids'] = json_encode($data['brokers_ids']);
        }

        $offer = $builder->create($data);

        $branch = Branch::find($data['branch_id']);
        $offer_code =  strtoupper($branch->code) . "-$offer->id-" . "USR" . $user->id;

        $real_estate = RealEstate::store($data);

        OfferEditor::store($offer->id, 'add');

        $offer->update([
            'real_estate_id' => $real_estate->id,
            'offer_code' => $offer_code
        ]);

        if ($offer) {
            return "تم إضافة العرض بنجاح";
        }

        return false;
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $offer = $builder->find($id);

        $sale_id = $offer->sale ? $offer->sale->id : '';
        $real_estate_id = $offer->real_estate_id;
        $real_estate_location_id = $offer->realEstate->location;

        Sale::deleteModel($sale_id);
        sleep(3);
        RealEstateLocation::deleteModel($real_estate_location_id);
        sleep(3);
        RealEstate::deleteModel($real_estate_id);

        if ($offer) {
            $offer->delete();
            return "تم حذف العرض بنجاح";
        }

        return false;
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $offer = $builder->find($id);
        if ($offer) {
            $offer->update([
                'status' => $offer->status == 1 ? 2 : 1
            ]);

            return "تم تغيير حالة العرض بنجاح";
        }

        return true;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $user = auth()->user();
        $data['updater'] = $user->id;

        if (array_key_exists('directions', $data)) {
            $data['directions'] = json_encode($data['directions']);
        }

        if (array_key_exists('street_width', $data)) {
            $data['street_width'] = json_encode($data['street_width']);
        }

        if (array_key_exists('brokers_ids', $data)) {
            $data['brokers_ids'] = json_encode($data['brokers_ids']);
        }

        $offer = $builder->find($id);

        $branch = Branch::find($data['branch_id']);
        $offer_code =  strtoupper($branch->code) . "-$offer->id-" . "USR" . $user->id;
        $data['offer_code'] = $offer_code;

        $real_estate_id = $offer->realEstate->id;

        RealEstate::updateModel($data, $real_estate_id);
        OfferEditor::store($offer->id, 'edit');

        if ($offer) {
            $offer->update($data);
            return "تم تعديل العرض بنجاح";
        }

        return false;
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [];
    }

    public function scopeGetMessages()
    {
        return [];
    }
}
