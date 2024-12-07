<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'position',
        'phone',
        'email',
        'salary',
        'hire_date',
        'farm_id'
    ];
    public const POSITIONS = [
        'Manager' => 'Manager',
        'Supervisor' => 'Supervisor',
        'Worker' => 'Worker',
        'Technician' => 'Technician',
        'Operator' => 'Operator'
    ];
   
    protected $casts = [
        'hire_date' => 'date',
        'salary' => 'decimal:2'
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
} 