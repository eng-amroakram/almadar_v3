<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        "creator",
        "updater"
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'nationality_id', 'id');
    }

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
            "creator",
            "updater",
        ]);
    }
}
