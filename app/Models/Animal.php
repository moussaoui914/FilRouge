<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'species',
        'birth_date',
        'health_status',
        'habitat_id',
        'description',
        'image',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function habitat(): BelongsTo
    {
        return $this->belongsTo(Habitat::class);
    }

    public function getAgeAttribute(): ?string
    {
        if (!$this->birth_date) return null;
        return $this->birth_date->diffForHumans(null, true);
    }

    public function getHealthBadgeColorAttribute(): string
    {
        return match($this->health_status) {
            'Excellent' => 'emerald',
            'Good'      => 'green',
            'Fair'      => 'yellow',
            'Poor'      => 'orange',
            'Critical'  => 'red',
            default     => 'gray',
        };
    }
}