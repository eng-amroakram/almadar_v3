<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sale_id',
        'seller_id',
        'reservation_id',
        'buyer_id',
        'offer_id',
        'amount',
        'payment_method',
        'check_number',
        'recipient_name',
        'bank',
    ];

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'user_id',
            'sale_id',
            'seller_id',
            'buyer_id',
            'reservation_id',
            'offer_id',
            'amount',
            'payment_method',
            'check_number',
            'recipient_name',
            'bank',
            'created_at',
            'updated_at',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(Client::class, 'seller_id', 'id');
    }

    public function buyer()
    {
        return $this->belongsTo(Client::class,'buyer_id', 'id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }

    public function getSaleCodeAttribute()
    {
        return $this->sale ? $this->sale->sale_code : 'None';
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'buyer_id' => null
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('recipient_name', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['buyer_id'] != null, function ($query) use ($filters) {
            $query->whereIn('buyer_id', $filters['buyer_id']);
        });
    }

    public function getPaymentMethodAttribute($value)
    {
        return $value;
    }

    public function getBankAttribute($value)
    {
        return $value;
    }

    public function getAmountStringAttribute($value)
    {
        return number_format((float)$this->amount, 2);
    }

    public function getBuyerNameAttribute()
    {
        return $this->buyer->name;
    }

    public function getSellerNameAttribute()
    {
        return $this->seller->name;
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $sale_payment = $builder->find($id);
        if ($sale_payment) {
            $sale_payment->delete();
            return "تم حذف الدفعة بنجاح";
        }

        return false;
    }

    public function scopeStore(Builder $builder, array $data = [])
    {
        $user = auth()->user();
        $data["user_id"] = $user->id;

        $sale_payment = $builder->create($data);

        $sale = Sale::find($data['sale_id']);

        if ($sale) {
            $sale->update([
                'amount_paid' => $sale->amount_paid + $data['amount']
            ]);
        }

        if ($sale_payment) {
            return "تم إضافة الدفعة بنجاح";
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $user = auth()->user();

        $sale_payment = $builder->find($id);

        if ($sale_payment) {
            $sale_payment->update($data);
            return "تم تعديل الدفعة بنجاح";
        }

        return false;
    }

    public function scopeGetRules(Builder $builder, $id = '')
    {
        return [
            'amount' => 'required|numeric',
            'payment_method' => 'required',
            'check_number' => 'required_if:payment_method,==,check',
            'recipient_name' => 'required_if:payment_method,==,check',
            'bank' => 'required_if:payment_method,==,check',
        ];
    }

    public function scopeGetMessages(Builder $builder)
    {
        return [
            'amount.required' => 'يجب إدخال المبلغ',
            'amount.numeric' => 'يجب إدخال المبلغ بشكل صحيح',
            'payment_method.required' => 'يجب إدخال طريقة الدفع',
            'check_number.required_if' => 'يجب إدخال رقم الشيك',
            'recipient_name.required_if' => 'يجب إدخال اسم المستلم',
            'bank.required_if' => 'يجب إدخال اسم البنك',
        ];
    }
}
