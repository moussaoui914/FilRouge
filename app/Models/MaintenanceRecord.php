<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'habitat_id',
        'maintainer_id',
        'maintenance_date',
        'type',
        'description',
        'status',
        'notes',
    ];

    protected $casts = [
        'maintenance_date' => 'datetime',
    ];

    public function habitat(): BelongsTo
    {
        return $this->belongsTo(Habitat::class);
    }

    public function maintainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'maintainer_id');
    }
}