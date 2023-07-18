<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferEditor extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'action',
        'offer_id',
        'user_id',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function scopeStore(Builder $builder, $offer_id, $status)
    {
        $user = auth()->user();
        $action = '';
        // ['edit', 'cancel', 'book', 'add', 'active', 'suspended', 'sell']
        $note = '';

        if ($status == "add") {
            $action = "add";
            $note = "تم اضافة العرض بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'offer_id' => $offer_id,
                'user_id' => $user->id,
            ]);
        }

        if ($status == "edit") {
            $action = "edit";
            $note = "تم تعديل العرض بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'offer_id' => $offer_id,
                'user_id' => $user->id,
            ]);
        }

        if ($status == "cancel") {
            $action = "cancel";
            $note = "تم الغاء العرض بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'offer_id' => $offer_id,
                'user_id' => $user->id,
            ]);
        }

        if ($status == "book") {
            $action = "book";
            $note = "تم حجز العرض بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'offer_id' => $offer_id,
                'user_id' => $user->id,
            ]);
        }

        if ($status == "active") {
            $action = "active";
            $note = "تم تفعيل العرض بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'offer_id' => $offer_id,
                'user_id' => $user->id,
            ]);
        }

        if ($status == "suspended") {
            $action = "suspended";
            $note = "تم ايقاف العرض بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'offer_id' => $offer_id,
                'user_id' => $user->id,
            ]);
        }

        if ($status == "sell") {
            $action = "sell";
            $note = "تم بيع العرض بواسطة {$user->name}";

            $builder->create([
                'note' => $note,
                'action' => $action,
                'offer_id' => $offer_id,
                'user_id' => $user->id,
            ]);
        }

        return $builder;
    }
}
