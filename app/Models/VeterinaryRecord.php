<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VeterinaryRecord extends Model
{
    use HasFactory;

    protected $table = 'veterinary_records';

    protected $fillable = [
        'animal_id',
        'veterinarian_id',
        'record_date',
        'type',
        'diagnosis',
        'treatment',
        'medication',
        'dosage',
        'next_appointment',
        'notes',
        'status',
    ];

    protected $casts = [
        'record_date' => 'datetime',
        'next_appointment' => 'datetime',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function veterinarian(): BelongsTo
    {
        return $this->belongsTo(User::class, 'veterinarian_id');
    }
}