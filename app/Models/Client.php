<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "city_id",
        "neighborhood_id",
        "nationality_id",

        "name",
        "phone",
        "email",
        "id_number_type",
        "id_number",
        "description",
        "employer",
        "zip_code",
        "building_number",
        "street_name",
        "neighborhood_name",
        "employment_type",
        "extra_figure",
        "unit_number",
        "housing_support",
        "status",
        "is_buy",

        "creator",
        "updater",
    ];

    public function scopeData($query)
    {
        return $query->select([
            "id",
            "user_id",
            "city_id",
            "neighborhood_id",
            "nationality_id",

            "name",
            "phone",
            "email",
            "id_number_type",
            "id_number",
            "description",
            "employer",
            "zip_code",
            "building_number",
            "street_name",
            "neighborhood_name",
            "employment_type",
            "extra_figure",
            "unit_number",
            "housing_support",
            "status",
            "is_buy",

            "creator",
            "updater",
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator', 'id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updater', 'id');
    }

    public function nationality()
    {
        return  $this->hasOne(Nationality::class, "id", "nationality_id");
    }

    public function reservation()
    {
        return  $this->hasOne(Reservation::class, "client_id", "id");
    }

    public function city()
    {
        return  $this->hasOne(City::class, "id", "city_id");
    }

    public function neighborhood()
    {
        return  $this->hasOne(Neighborhood::class, "id", "neighborhood_id");
    }

    public function orders()
    {
        return $this->hasMany(User::class, 'client_id', 'id');
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
            'city_id' => null,
            'employment_type' => null,
            'is_buy' => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query
                ->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                ->orWhere('id_number', 'like', '%' . $filters['search'] . '%')
                ->orWhere('employer', 'like', '%' . $filters['search'] . '%')
                ->orWhere('zip_code', 'like', '%' . $filters['search'] . '%')
                ->orWhere('building_number', 'like', '%' . $filters['search'] . '%')
                ->orWhere('street_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('unit_number', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });

        $builder->when($filters['search'] == '' && $filters['employment_type'] != null, function ($query) use ($filters) {
            $query->whereIn('employment_type', $filters['employment_type']);
        });

        $builder->when($filters['search'] == '' && $filters['city_id'] != null, function ($query) use ($filters) {
            $query->whereIn('city_id', $filters['city_id']);
        });

        $builder->when($filters['search'] == '' && $filters['is_buy'] != null, function ($query) use ($filters) {
            $query->whereIn('is_buy', $filters['is_buy']);
        });
    }

    public function getEmploymentTypeNameAttribute()
    {
        if ($this->attributes['employment_type'] == 'public') {
            return "عام";
        }

        if ($this->attributes['employment_type'] == 'private') {
            return "خاص";
        }

        return "غير محدد";
    }

    public function getCityNameAttribute()
    {
        $city = $this->city()->first();

        if ($city) {
            return $city->name;
        }

        return "No Found City";
    }

    public function getClientNeighborhoodNameAttribute()
    {
        $neighborhood = $this->neighborhood()->first();

        if ($neighborhood) {
            return $neighborhood->name;
        }

        return "None";
    }

    public function getIsBuyNameAttribute()
    {
        if ($this->attributes['is_buy'] == 2) {
            return "لا";
        }

        if ($this->attributes['is_buy'] == 1) {
            return "نعم";
        }

        return "غير محدد";
    }

    public function scopeGetRules(Builder $builder, $id)
    {
        return [
            "name" => ['required', 'string', 'max:50'],
            "phone" => ["required", "string", "min:10", "max:10", "unique:clients,phone,$id"],
            "email" => ["nullable", "string", "unique:clients,email,$id"],
            "employer" => ["nullable", "string",],
            "zip_code" => ["nullable", "string"],
            "employment_type" => ["nullable", 'in:public,private'],
            "id_number" => ["nullable", "string", "unique:clients,id_number,$id"],
            "extra_figure" => ["nullable", "string",],
            "housing_support" => ["nullable"],
            "unit_number" => ["nullable", "numeric"],
            // "status" => ['in:1,2'],
            // "is_buy" => ["in:1,2"],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "name.required" => "حقل اسم العميل مطلوب",
            "phone.required" => "حقل رقم الهاتف مطلوب",
            "phone.unique" => "رقم الهاتف موجود مسبقا",
            "email.unique" => "البريد الإلكتروني موجود مسبقا",
            "phone.min" => "يجب أن يكون رقم الهاتف 10 أرقام",
            "phone.max" => "يجب أن يكون رقم الهاتف 10 أرقام",
        ];
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $client = $builder->find($id);

        if ($client) {
            $client->delete();
            return "تم حذف العميل بنجاح";
        }

        return false;
    }

    public function scopeUpdateOrCreateModel(Builder $builder, $data)
    {
        $data['user_id'] = auth()->id();
        $data['creator'] = auth()->id();
        $data['updater'] = auth()->id();

        $client = $builder->where('phone', $data['phone'])->first();

        if ($client) {
            $client->update($data);
            return $client;
        }

        $client = $builder->create($data);

        if ($client) {
            return $client;
        }

        return false;
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $client = $builder->find($id);

        if ($client) {
            $client->update([
                'status' => $client->status == 1 ? 2 : 1
            ]);
            return "تم تغير حالة العميل بنجاح";
        }

        return false;
    }

    public function scopeStore(Builder $builder, $data)
    {
        $user = auth()->user();
        $data["user_id"] = $user->id;
        $data["creator"] = $user->id;

        $client = $builder->create($data);

        if ($client) {
            return "تم إضافة العميل بنجاح";
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $user = auth()->user();
        $data["updater"] = $user->id;

        $client = $builder->find($id);

        if ($client) {
            $client->update($data);
            return "تم تعديل العميل بنجاح";
        }

        return false;
    }
}
