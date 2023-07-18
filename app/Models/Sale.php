<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        "sale_code",
        "offer_id",
        "user_id",
        "seller_id",
        "buyer_id",
        "real_estate_id",
        "broker_id",
        "real_estate_price",
        "is_first_home",
        "deserved_amount",
        "commission_vat",
        "commission_type",
        "commission_percentage",
        "commission_price",
        "amount_paid",
        "total_amount",
        "payment_method",
        "check_number",
        "recipient_name",
        "bank",
        "status",
        "note",
        "creator",
        "updater",
    ];

    public function scopeData($query)
    {
        return $query->select([
            "id",
            "sale_code",
            "offer_id",
            "user_id",
            "seller_id",
            "buyer_id",
            "real_estate_id",
            "broker_id",
            "real_estate_price",
            "is_first_home",
            "deserved_amount",
            "commission_vat",
            "commission_type",
            "commission_percentage",
            "commission_price",
            "amount_paid",
            "total_amount",
            "payment_method",
            "check_number",
            "recipient_name",
            "bank",
            "status",
            "note",
            "creator",
            "updater",
            "created_at"
        ]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
        ], $filters);
    }

    public function getPropertyTypeAttribute()
    {
        return $this->realEstate->real_estate_type;
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(Client::class, 'seller_id', 'id');
    }

    public function buyer()
    {
        return $this->belongsTo(Client::class, 'buyer_id', 'id');
    }

    public function realEstate()
    {
        return $this->belongsTo(RealEstate::class, 'real_estate_id', 'id');
    }

    public function broker()
    {
        return $this->belongsTo(Broker::class, 'broker_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator', 'id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updater', 'id');
    }

    public function salePayments()
    {
        return $this->hasMany(SalePayment::class, 'sale_id', 'id');
    }

    public function salePayment()
    {
        return $this->hasOne(SalePayment::class, 'sale_id', 'id');
    }

    public function getPricePercentageAttribute()
    {
        return $this->real_estate_price * $this->commission_percentage / 100;
    }

    public function getCreatedAtFromatedAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function getCityNameAttribute()
    {
        return $this->realEstate->location->city->name;
    }

    public function getRealEstateTypeAttribute()
    {
        return __($this->realEstate->real_estate_type);
    }

    public function getLandNumberAttribute()
    {
        return $this->realEstate->land_number;
    }

    public function getSpaceAttribute()
    {
        return $this->realEstate->space;
    }

    public function getPriceCommissionVatAttribute()
    {
        return $this->real_estate_price * ($this->commission_vat) / 100;
    }

    public function getRemainingAmountAttribute()
    {
        return ($this->real_estate_price + $this->price_commission_vat + $this->price_percentage) - $this->amount_paid;
    }

    public function getRemainingAmountStringAttribute()
    {
        return number_format(($this->real_estate_price + $this->price_commission_vat + $this->price_percentage) - $this->amount_paid);
    }

    public function getAmountPaidStringAttribute()
    {
        return number_format($this->amount_paid);
    }

    public function getRealEstatePriceStringAttribute()
    {
        return number_format($this->real_estate_price);
    }

    public function getSpaceStringAttribute()
    {
        return number_format($this->realEstate->space);
    }

    public function getClientEmploymentTypeAttribute()
    {
        return __($this->buyer->employment_type);
    }

    public function getBranchNameAttribute()
    {
        return $this->realEstate->location->branch->name;
    }

    public function scopeGetRules(Builder $builder, $id)
    {
        return [
            "is_first_home" => ["required"],
            "deserved_amount" => [],
            "commission_vat" => [],

            "commission_type" => ["required"],
            "commission_percentage" => [],
            "commission_price" => [],

            "payment_method" => ["required"],
            "bank" => [],
            "check_number" => [],
            "recipient_name" => [],

            "amount_paid" => ["required"],

            //Client Buyer
            "client_buyer_id" => ["required"],
            "client_buyer_name" => ["required"],
            "client_buyer_phone" => ["required"],
            "client_buyer_id_number_type" => ["required"],
            "client_buyer_id_number" => ["required", "unique:clients,id_number"],
            "client_buyer_email" => ["required", "email"],
            "client_buyer_description" => ["required"],
            "client_buyer_nationality_id" => ["required"],
            "client_buyer_city_id" => ["required"],
            "client_buyer_neighborhood_name" => ["required"],
            "client_buyer_employment_type" => ["required"],
            "client_buyer_housing_support" => ["required"],
            "client_buyer_building_number" => ["required"],
            "client_buyer_street_name" => ["required"],
            "client_buyer_zip_code" => ["required"],
            "client_buyer_extra_figure" => ["required"],
            "client_buyer_unit_number" => ["required"],

            //Client Seller
            "client_seller_id" => ["required"],
            "client_seller_name" => ["required"],
            "client_seller_phone" => ["required"],
            "client_seller_id_number_type" => ["required"],
            "client_seller_id_number" => ["required", "unique:clients,id_number"],
            "client_seller_email" => ["required", "email"],
            "client_seller_description" => ["required"],
            "client_seller_nationality_id" => ["required"],
            "client_seller_city_id" => ["required"],
            "client_seller_neighborhood_name" => ["required"],
            "client_seller_employment_type" => ["required"],
            "client_seller_housing_support" => ["required"],
            "client_seller_building_number" => ["required"],
            "client_seller_street_name" => ["required"],
            "client_seller_zip_code" => ["required"],
            "client_seller_extra_figure" => ["required"],
            "client_seller_unit_number" => ["required"],

        ];
    }

    public function scopeGetMessages()
    {
        return [
            "is_first_home.required" => "يجب اختيار نوع العمولة",
            "deserved_amount.required" => "يجب ادخال المبلغ المستحق",
            "commission_vat.required" => "يجب ادخال العمولة بالضريبة",

            "commission_type.required" => "يجب اختيار نوع العمولة",
            "commission_percentage.required" => "يجب ادخال نسبة العمولة",
            "commission_price.required" => "يجب ادخال قيمة العمولة",

            "payment_method.required" => "يجب اختيار طريقة الدفع",
            "bank.required" => "يجب ادخال اسم البنك",
            "check_number.required" => "يجب ادخال رقم الشيك",
            "recipient_name.required" => "يجب ادخال اسم المستلم",

            "amount_paid.required" => "يجب ادخال المبلغ المدفوع",

            //Client Buyer
            "client_buyer_id.required" => "يجب اختيار العميل",
            "client_buyer_name.required" => "يجب ادخال اسم العميل",
            "client_buyer_phone.required" => "يجب ادخال رقم الهاتف",
            "client_buyer_id_number_type.required" => "يجب اختيار نوع الهوية",
            "client_buyer_id_number.required" => "يجب ادخال رقم الهوية",
            "client_buyer_id_number.unique" => "رقم الهوية موجود مسبقا",
            "client_buyer_email.required" => "يجب ادخال البريد الالكتروني",
            "client_buyer_description.required" => "يجب ادخال وصف العميل",
            "client_buyer_nationality_id.required" => "يجب اختيار الجنسية",
            "client_buyer_city_id.required" => "يجب اختيار المدينة",
            "client_buyer_neighborhood_name.required" => "يجب ادخال اسم الحي",
            "client_buyer_employment_type.required" => "يجب اختيار نوع العمل",
            "client_buyer_housing_support.required" => "يجب اختيار دعم سكني",
            "client_buyer_building_number.required" => "يجب ادخال رقم المبنى",
            "client_buyer_street_name.required" => "يجب ادخال اسم الشارع",
            "client_buyer_zip_code.required" => "يجب ادخال الرمز البريدي",
            "client_buyer_extra_figure.required" => "يجب ادخال الرقم الاضافي",
            "client_buyer_unit_number.required" => "يجب ادخال رقم الوحدة",

            //Client Seller
            "client_seller_id.required" => "يجب اختيار العميل",
            "client_seller_name.required" => "يجب ادخال اسم العميل",
            "client_seller_phone.required" => "يجب ادخال رقم الهاتف",
            "client_seller_id_number_type.required" => "يجب اختيار نوع الهوية",
            "client_seller_id_number.required" => "يجب ادخال رقم الهوية",
            "client_seller_id_number.unique" => "رقم الهوية موجود مسبقا",
            "client_seller_email.required" => "يجب ادخال البريد الالكتروني",
            "client_seller_description.required" => "يجب ادخال وصف العميل",
            "client_seller_nationality_id.required" => "يجب اختيار الجنسية",
            "client_seller_city_id.required" => "يجب اختيار المدينة",
            "client_seller_neighborhood_name.required" => "يجب ادخال اسم الحي",
            "client_seller_employment_type.required" => "يجب اختيار نوع العمل",
            "client_seller_housing_support.required" => "يجب اختيار دعم سكني",
            "client_seller_building_number.required" => "يجب ادخال رقم المبنى",
            "client_seller_street_name.required" => "يجب ادخال اسم الشارع",
            "client_seller_zip_code.required" => "يجب ادخال الرمز البريدي",
            "client_seller_extra_figure.required" => "يجب ادخال الرقم الاضافي",
            "client_seller_unit_number.required" => "يجب ادخال رقم الوحدة",

        ];
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        return "عملة الحذف غير مدعومة، يرجى التواصل مع الدعم الفني";
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $sale = $builder->find($id);
        if ($sale) {
            $sale->update([
                'status' => $sale->status == 1 ? 2 : 1
            ]);
            return "تم تغير حالة الصفقة بنجاح";
        }

        return true;
    }

    public function scopeStore(Builder $builder, $data)
    {
        $buyer_prefix = "client_buyer_";
        $seller_prefix = "client_seller_";


        $client_buyer = [];
        $client_seller = [];

        $sale_step_one = [];

        foreach ($data as $key => $value) {
            if (strpos($key, $buyer_prefix) === 0) {
                $new_key = substr($key, strlen($buyer_prefix));
                $client_buyer[$new_key] = $value;
            } else {
                $sale_step_one[$key] = $value;
            }
        }

        $sale = [];

        foreach ($sale_step_one as $key => $value) {
            if (strpos($key, $seller_prefix) === 0) {
                $new_key = substr($key, strlen($seller_prefix));
                $client_seller[$new_key] = $value;
            } else {
                $sale[$key] = $value;
            }
        }

        $buyer = Client::updateOrCreateModel($client_buyer);
        $seller = Client::updateOrCreateModel($client_seller);

        $offer = Offer::find($sale['offer_id']);
        $real_estate = $offer->realEstate;

        $sale['buyer_id'] = $buyer->id;
        $sale['seller_id'] = $seller->id;
        $sale['real_estate_id'] = $real_estate->id;
        $sale['creator'] = auth()->id();
        $sale['user_id'] = auth()->id();
        $sale['status'] = 1;

        $branch_code = $offer->branch_code;

        $sale = $builder->create($sale);
        $sale_code = $branch_code . '-' . $sale->id . '-' . "USR" . auth()->id();

        $reservation = $offer->reservation;
        $price_reservarion = $reservation ? $reservation->price : 0;

        SalePayment::create([
            'user_id' => auth()->id(),
            'seller_id' => $sale->seller_id,
            'buyer_id' => $sale->buyer_id,
            'sale_id' => $sale->id,
            'reservation_id' => null,
            'offer_id' => $sale->offer_id,
            'amount' => $sale->amount_paid,
            'payment_method' => $sale->payment_method,
            'check_number' => $sale->check_number,
            'recipient_name' => $sale->recipient_name,
            'bank' => $sale->bank,
        ]);

        $sale->update([
            "sale_code" => $sale_code,
            'amount_paid' => $sale->amount_paid + $price_reservarion
        ]);

        $sale_payment = $reservation->salePayment;

        if ($sale_payment) {
            $sale_payment->update([
                'sale_id' => $sale->id,
                'seller_id' => $sale->seller_id
            ]);
        }

        $real_estate->update([
            "property_status" => 'sold'
        ]);

        OfferEditor::store($offer->id, 'sell');

        if ($sale) {
            return "تم إنشاء صفقة البيع بنجاح";
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $buyer_prefix = "client_buyer_";
        $seller_prefix = "client_seller_";

        $client_buyer = [];
        $client_seller = [];

        $sale_step_one = [];

        foreach ($data as $key => $value) {
            if (strpos($key, $buyer_prefix) === 0) {
                $new_key = substr($key, strlen($buyer_prefix));
                $client_buyer[$new_key] = $value;
            } else {
                $sale_step_one[$key] = $value;
            }
        }

        $sale = [];

        foreach ($sale_step_one as $key => $value) {
            if (strpos($key, $seller_prefix) === 0) {
                $new_key = substr($key, strlen($seller_prefix));
                $client_seller[$new_key] = $value;
            } else {
                $sale[$key] = $value;
            }
        }

        $buyer = Client::updateOrCreateModel($client_buyer);
        $seller = Client::updateOrCreateModel($client_seller);

        $offer = Offer::find($sale['offer_id']);
        $real_estate = $offer->realEstate;

        $sale['buyer_id'] = $buyer->id;
        $sale['seller_id'] = $seller->id;
        $sale['real_estate_id'] = $real_estate->id;
        $sale['updater'] = auth()->id();

        $sale_model = $builder->find($id)->update($sale);

        if ($sale_model) {
            return "تم تعديل صفقة البيع بنجاح";
        }

        return false;
    }
}
