<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name",
        "phone",
        "type",
        "status",
        "creator",
        "updater"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'broker_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            "id",
            "user_id",
            "name",
            "phone",
            "type",
            "status",
            "creator",
            "updater"
        ]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
            'type' => null

        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                ->orWhere('id', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });

        $builder->when($filters['search'] == '' && $filters['type'] != null, function ($query) use ($filters) {
            $query->whereIn('type', $filters['type']);
        });
    }

    public function getTypeNameAttribute()
    {
        if ($this->attributes["type"] == "office") {
            return "مكتب";
        }

        if ($this->attributes["type"] == "person") {
            return "فرد";
        }
    }

    public function scopeGetRules(Builder $builder, $id)
    {
        return [
            "name" => ["required", "string", "unique:brokers,name,$id"],
            "phone" => ["required", "string", "unique:brokers,phone,$id"],
            "type" => ["required", "string", "in:office,person"],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "name.required" => "يرجى إدخال اسم الوسيط",
            "name.string" => "يرجى إدخال اسم الوسيط بشكل صحيح",
            "name.unique" => "اسم الوسيط موجود مسبقاً",
            "phone.required" => "يرجى إدخال رقم الجوال",
            "phone.string" => "يرجى إدخال رقم الجوال بشكل صحيح",
            "phone.unique" => "رقم الجوال موجود مسبقاً",
            "type.required" => "يرجى إدخال نوع الوسيط",
            "type.string" => "يرجى إدخال نوع الوسيط بشكل صحيح",
            "type.in" => "يرجى إدخال نوع الوسيط بشكل صحيح",
        ];
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $broker = $builder->find($id);
        if ($broker) {
            $broker->delete();
            return "تم حذف الوسيط بنجاح";
        }

        return false;
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $broker = $builder->find($id);
        if ($broker) {
            $broker->update([
                'status' => $broker->status == 1 ? 2 : 1
            ]);
            return "تم تغير حالة الوسيط بنجاح";
        }

        return true;
    }

    public function scopeStore(Builder $builder, array $data = [])
    {
        $user = auth()->user();
        $data["user_id"] = $user->id;
        $data["creator"] = $user->id;

        $broker = $builder->create($data);

        if ($broker) {
            return "تم إضافة الوسيط بنجاح";
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $user = auth()->user();
        $data['updater'] = $user->id;

        $broker = $builder->find($id);

        if ($broker) {
            $broker->update($data);
            return "تم تعديل الوسيط بنجاح";
        }

        return false;
    }
}
