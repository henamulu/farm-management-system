<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable = [
        'name',
        'location',
        'owner_id',
        'size',
        'status'
    ];

    public function crops()
    {
        return $this->hasMany(Crop::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
} 