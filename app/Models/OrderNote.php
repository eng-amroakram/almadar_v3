<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'status',
        'order_id',
        'user_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeGetRules(Builder $builder, $id)
    {
        return [
            'note' => 'required|string',
            'status' => 'required|in:' . implode(',', config('data.order-notes-statuses')),
        ];
    }

    public function scopeGetMessages()
    {
        return [
            'note.required' => 'يجب ادخال الملاحظة',
            'note.string' => 'يجب ان تكون الملاحظة نص',
            'status.required' => 'يجب ادخال حالة الملاحظة',
            'status.in' => 'يجب ان تكون حالة الملاحظة من القيم المسموحة',
        ];
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function scopeDeleteModel($builder, $id)
    {
    }

    public function scopeStatus($builder, $id)
    {
    }

    public function scopeStore(Builder $builder, $data)
    {
        $user = auth()->user();
        $data["user_id"] = $user->id;

        $order_note = $builder->create($data);

        if ($order_note) {
            return "تم اضافة الملاحظة بنجاح";
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        dd($data, $id);
    }
}
