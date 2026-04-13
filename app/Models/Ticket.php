<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_name',
        'visitor_email',
        'ticket_type',
        'price',
        'purchase_date',
        'visit_date',
        'qr_code',
        'status',
        'user_id',
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'visit_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2) . ' €';
    }
}