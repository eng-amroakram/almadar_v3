<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderEditor extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'action',
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

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function scopeStore(Builder $builder, $order_id, $status)
    {
        $user = auth()->user();
        $action = '';
        // 'edit', 'cancel', 'add', 'active', 'suspended'
        $note = '';

        if ($status == "new") {
            $action = "add";
            $note = "تم اضافة الطلب بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'order_id' => $order_id,
                'user_id' => $user->id,
            ]);
        }

        if ($status == "edit") {
            $action = "edit";
            $note = "تم تعديل الطلب بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'order_id' => $order_id,
                'user_id' => $user->id,
            ]);
        }

        if ($status == "client_not_wish") {
            $action = "cancel";
            $note = "تم اغلاق الطلب بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'order_id' => $order_id,
                'user_id' => $user->id,
            ]);

            Order::close();
        }

        if ($status == "request_suspension") {
            $action = "suspended";
            $note = "تم تعليق الطلب بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'order_id' => $order_id,
                'user_id' => $user->id,
            ]);

            Order::suspend();
        }

        if ($status == "linked_to_offer") {
            $action = "edit";
            $note = "تم ربط الطلب بالعرض بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'order_id' => $order_id,
                'user_id' => $user->id,
            ]);

            Order::linkedToOffer();
        }

        if ($status == "active") {
            $action = "active";
            $note = "تم اعادة تفعيل الطلب بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'order_id' => $order_id,
                'user_id' => $user->id,
            ]);

            Order::requestNotProcessed();
        }

        if ($status == "customer_contacted") {
            $action = "follow_up_request";
            $note = "تم طلب متابعة الطلب";
            Order::followUpRequest();
        }

        return $note;
    }
}
