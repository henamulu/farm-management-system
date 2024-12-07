<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'crop_id',
        'category',
        'planned_amount',
        'actual_amount',
        'period_start',
        'period_end',
        'notes'
    ];

    protected $casts = [
        'planned_amount' => 'decimal:2',
        'actual_amount' => 'decimal:2',
        'period_start' => 'date',
        'period_end' => 'date'
    ];

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function getVarianceAttribute()
    {
        return $this->planned_amount - $this->actual_amount;
    }

    public function getVariancePercentageAttribute()
    {
        if ($this->planned_amount == 0) return 0;
        return ($this->variance / $this->planned_amount) * 100;
    }

    public function isOverBudget()
    {
        return $this->actual_amount > $this->planned_amount;
    }
} 