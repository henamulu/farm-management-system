<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    protected $fillable = [
        'type', // 'income' o 'expense'
        'amount',
        'description',
        'category',
        'date',
        'farm_id',
        'crop_id',
        'created_by',
        'payment_method',
        'status',
        'reference_number'
    ];

    protected $casts = [
        'date' => 'datetime',
        'amount' => 'decimal:2'
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
} 