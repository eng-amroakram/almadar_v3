<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "client_id",
        "offer_id",
        "price",
        "status",
        "date_from",
        "date_to",
        "payment_method",
        "check_number",
        "recipient_name",
        "bank",
        "note",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function client()
    {
        return $this->belongsTo(Client::class, "client_id", "id");
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, "offer_id", "id");
    }

    public function salePayment()
    {
        return $this->hasOne(SalePayment::class, "reservation_id", "id");
    }

    public function getClientNameAttribute()
    {
        return $this->client->name;
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getOfferCodeAttribute()
    {
        $this->offer->offer_code;
    }

    public function getPriceStringAttribute()
    {
        return number_format($this->price) . " ريال";
    }

    public function getPeriodAttribute()
    {
        return $this->date_from . " - " . $this->date_to;
    }

    public function getDateAttribute()
    {
        return $this->created_at->format("Y-m-d");
    }




    public function scopeData($query)
    {
        return $query->select([
            "id",
            "user_id",
            "client_id",
            "offer_id",
            "price",
            "status",
            "date_from",
            "date_to",
            "payment_method",
            "check_number",
            "recipient_name",
            "bank",
            "note",
            "created_at",
        ]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
            'date_from' => null,
            'date_to' => null,
        ], $filters);
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            "client_id" => "required",
            "price" => "required",
            "date_from" => "required",
            "date_to" => "required",
            "payment_method" => "required",
            "note" => "required",
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "client_id.required" => "حقل العميل مطلوب.",
            "price.required" => "حقل السعر مطلوب.",
            "date_from.required" => "حقل تاريخ البداية مطلوب.",
            "date_to.required" => "حقل تاريخ النهاية مطلوب.",
            "payment_method.required" => "حقل طريقة الدفع مطلوب.",
            "note.required" => "حقل الملاحظات مطلوب.",
        ];
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $user = $builder->find($id);
        if ($user) {
            $user->delete();
            return "تم حذف الحجز بنجاح";
        }

        return false;
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $reservation = $builder->find($id);
        if ($reservation) {
            $reservation->update([
                'status' => $reservation->status == 1 ? 2 : 1
            ]);
            return "تم تغير حالة الحجز بنجاح";
        }

        return true;
    }

    public function scopeStore(Builder $builder, array $data = [])
    {
        dd($data);
        return false;
    }
}
