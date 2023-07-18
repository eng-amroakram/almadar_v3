<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "offer_id",
        "client_id",
        "user_id",
        "city_id",
        "neighborhood_id",
        "real_estate_id",
        "branch_id",
        "order_code",
        "space",
        "start_price",
        "end_price",
        "amount",
        "notes",
        "payment_method",
        "time_purchase",
        "status",
        "property_type",
        "attribution",
        "attribution_date",
        "closing",
        "closer",
        "creator",
        "updater",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id', 'id');
    }

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class, 'real_estate_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function orderNotes()
    {
        return $this->hasMany(OrderNote::class, 'order_id', 'id');
    }

    public function orderEdits()
    {
        return $this->hasMany(OrderEditor::class, 'order_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            "id",
            "offer_id",
            "client_id",
            "user_id",
            "city_id",
            "neighborhood_id",
            "real_estate_id",
            "branch_id",
            "order_code",
            "space",
            "start_price",
            "end_price",
            "amount",
            "notes",
            "payment_method",
            "time_purchase",
            "status",
            "property_type",
            "attribution",
            "attribution_date",
            "closing",
            "creator",
            "updater",
            "closer",
            "created_at",
            "updated_at",
        ]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'city_id' => null,
            'neighborhood_id' => null,
            'status' => null,
            'property_type' => null,
            "date_from" => null,
            "date_to" => null,
        ], $filters);

        $builder->when($filters['search'] == '' && ($filters['date_from'] || $filters['date_to']), function ($query) use ($filters) {
            $query->whereBetween('created_at', [$filters['date_from'], $filters['date_to']])
                ->orderBy('created_at', 'ASC');
        });

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('order_code', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['city_id'] != null, function ($query) use ($filters) {
            $query->whereIn('city_id', $filters['city_id']);
        });

        $builder->when($filters['search'] == '' && $filters['neighborhood_id'] != null, function ($query) use ($filters) {
            $query->whereIn('neighborhood_id', $filters['neighborhood_id']);
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });

        $builder->when($filters['search'] == '' && $filters['property_type'] != null, function ($query) use ($filters) {
            $query->whereIn('property_type', $filters['property_type']);
        });
    }

    public function getRealEstateTypeAttribute()
    {
        return __($this->property_type);
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getAttributionNameAttribute()
    {
        $user = User::find($this->attributes['attribution']);
        return $user ? $user->name : "غير محدد";
    }

    public function getClientNameAttribute()
    {
        return $this->client->name;
    }

    public function getClientEmployerAttribute()
    {
        return $this->client->employer;
    }

    public function getClientPhoneAttribute()
    {
        return $this->client->phone;
    }

    public function getClientIsBuyAttribute()
    {
        return $this->client->is_buy;
    }

    public function getClientEmploymentTypeAttribute()
    {
        return $this->client->employment_type;
    }

    public function getHousingSupportAttribute()
    {
        return $this->client->housing_support  == 1 ? 'نعم' : 'لا';
    }

    public function getCityNameAttribute()
    {
        return $this->city->name;
    }

    public function getNeighborhoodNameAttribute()
    {
        return $this->neighborhood->name;
    }

    public function getBranchNameAttribute()
    {
        return $this->branch->name;
    }

    public function getBudgetAttribute()
    {
        return number_format($this->start_price) . " - " . number_format($this->end_price) . "   ريال";
    }

    public function getOrderStatusAttribute()
    {
        return __($this->status);
    }

    public function getCreatedAtFormatedAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function scopeGetRules(Builder $builder, $id)
    {
        return [
            // "offer_id" => "nullable",
            // "client_id" => ["required", "exists:clients,id,$client_id"],
            // "city_id" => ["required", "exists:cities,id,$city_id"],
            // "neighborhood_id" => ["required", "exists:neighborhoods,id,$id"],
            // "real_estate_id" => ["required", "exists:real_estates,id,$id"],
            // "branch_id" => ["required", "exists:branches,id,$id"],
            // "order_code" => ["required", "unique:orders,order_code,$id"],
            "space" => ["required", "numeric"],
            "start_price" => ["required", "numeric"],
            "end_price" => ["required", "numeric"],
            "amount" => ["required", "numeric"],
            // "notes" => ["required"],
            "payment_method" => ["required", 'in:cash_money,bank_check,bank_transfer'],
            "time_purchase" => ["required", 'in:ready_to_buy,6_months_later,after_one_year,after_two_years'],
            // "status" => ["required", "in,new,linked_to_offer,closed,follow_up_request,request_not_processed,hanging"],
            "client_name" => ['required', 'string', 'max:255'],
            "client_phone" => ['required', 'string', 'max:10'],
            "client_employer" => ['required', 'string', 'max:255'],
            "client_is_buy" => ["required", "in:1,2"],
            "client_employment_type" => ["required", "in:public,private"],
            "property_type" => ["required", "in:land,duplex,condominium,flat,chalet,warehouse_land,agircultural_land,industrial_land,residential_land,"],
            // "attribution" => ["required", "exists:users,id,$id"],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "space.required" => "حقل المساحة مطلوب",
            "space.numeric" => "حقل المساحة يجب ان يكون رقم",
            "start_price.required" => "حقل السعر الابتدائي مطلوب",
            "start_price.numeric" => "حقل السعر الابتدائي يجب ان يكون رقم",
            "end_price.required" => "حقل السعر النهائي مطلوب",
            "end_price.numeric" => "حقل السعر النهائي يجب ان يكون رقم",
            "amount.required" => "حقل المبلغ مطلوب",
            "amount.numeric" => "حقل المبلغ يجب ان يكون رقم",
            // "notes.required" => "حقل الملاحظات مطلوب",
            "payment_method.required" => "حقل طريقة الدفع مطلوب",
            "payment_method.in" => "حقل طريقة الدفع يجب ان يكون cash_money او bank_check او bank_transfer",
            "time_purchase.required" => "حقل وقت الشراء مطلوب",
            "time_purchase.in" => "حقل وقت الشراء يجب ان يكون ready_to_buy او 6_months_later او after_one_year او after_two_years",
            // "status.required" => "حقل حالة الطلب مطلوب",
            // "status.in" => "حقل حالة الطلب يجب ان يكون new او linked_to_offer او closed او follow_up_request او request_not_processed او hanging",
            "client_name.required" => "حقل اسم العميل مطلوب",
            "client_name.string" => "حقل اسم العميل يجب ان يكون نص",
            "client_name.max" => "حقل اسم العميل يجب ان لا يزيد عن 255 حرف",
            "client_phone.required" => "حقل رقم الهاتف مطلوب",
            "client_phone.string" => "حقل رقم الهاتف يجب ان يكون نص",
            "client_phone.max" => "حقل رقم الهاتف يجب ان لا يزيد عن 10 ارقام",
            "client_employer.required" => "حقل جهة العمل مطلوب",
            "client_employer.string" => "حقل جهة العمل يجب ان يكون نص",
            "client_employer.max" => "حقل جهة العمل يجب ان لا يزيد عن 255 حرف",
            "client_is_buy.required" => "حقل هل العميل يرغب في الشراء مطلوب",
            "client_is_buy.in" => "حقل هل العميل يرغب في الشراء يجب ان يكون 1 او 2",
            "client_employment_type.required" => "حقل نوع العمل مطلوب",
            "client_employment_type.in" => "حقل نوع العمل يجب ان يكون public او private",
            "property_type.required" => "حقل نوع العقار مطلوب",
            "property_type.in" => "حقل نوع العقار يجب ان يكون land او duplex او condominium او flat او chalet او warehouse_land او agircultural_land او industrial_land او residential_land",
            // "attribution.required" => "حقل المسؤول مطلوب",
        ];
    }

    public function scopeDeleteModel($builder, $id)
    {
        $order = $builder->find($id);

        $offer = $order->offer;

        if ($offer) {
            $offer->update([
                'order_id' => null
            ]);
        }

        if ($order) {
            $order->delete();
            return "تم حذف الطلب بنجاح";
        }

        return false;
    }

    public function scopeClose($builder)
    {
        $builder->update([
            'status' => 'closed',
            "closing" => now(),
            "closer" => auth()->id(),
            "updater" => auth()->id(),
        ]);
    }

    public function scopeRequestNotProcessed($builder)
    {
        $builder->update([
            'status' => 'request_not_processed',
            "updater" => auth()->id(),
        ]);
    }

    public function scopeSuspend($builder)
    {
        $builder->update([
            'status' => 'hanging',
            "updater" => auth()->id(),
        ]);
    }

    public function scopeLinkedToOffer($builder)
    {
        $builder->update([
            'status' => 'linked_to_offer',
            "updater" => auth()->id(),
        ]);
    }

    public function scopeFollowUpRequest($builder)
    {
        $builder->update([
            'status' => 'follow_up_request',
            "updater" => auth()->id(),
        ]);
    }

    public function scopeStatus($builder, $id)
    {
        dd($id);
    }

    public function scopeStore(Builder $builder, $data)
    {
        $user = auth()->user();
        $data["user_id"] = $user->id;
        $data["creator"] = $user->id;
        $data['status'] = 'new';

        $branch = Branch::find($data['branch_id']);

        $data['attribution_date'] =  $data['attribution_check'] ? now() : null;
        $data['attribution'] =  $data['attribution_check'] ? $data['attribution'] : null;

        $order = $builder->create($data);

        $order_code = strtoupper($branch->code)  . "-$order->id-" . "USR" . $user->id;


        $order->update([
            'order_code' => $order_code
        ]);

        OrderEditor::store($order->id, "new");

        if ($order) {
            return "تم اضافة الطلب بنجاح";
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $user = auth()->user();
        $data["updater"] = $user->id;

        $data['attribution_date'] =  $data['attribution_check'] ? now() : null;
        $data['attribution'] =  $data['attribution_check'] ? $data['attribution'] : null;

        $order = $builder->find($id);

        OrderEditor::store($order->id, "edit");

        if ($order) {
            $order->update($data);
            return "تم تعديل الطلب بنجاح";
        }

        return false;
    }
}
