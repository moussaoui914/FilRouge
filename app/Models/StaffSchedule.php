<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'shift_start',
        'shift_end',
        'sector',
        'tasks',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'shift_start' => 'datetime',
        'shift_end' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}