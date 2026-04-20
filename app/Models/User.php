<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

        public function isResponsable(): bool
    {
        return $this->role === 'responsable';
    }

    public function isSoigneur(): bool
    {
        return $this->role === 'soigneur';
    }

    public function isVeterinaire(): bool
    {
        return $this->role === 'veterinaire';
    }

    public function isBilletterie(): bool
    {
        return $this->role === 'billetterie';
    }

    public function isMaintenance(): bool
    {
        return $this->role === 'maintenance';
    }

    public function veterinaryRecords()
    {
        return $this->hasMany(VeterinaryRecord::class, 'veterinarian_id');
    }

    public function schedules()
    {
        return $this->hasMany(StaffSchedule::class);
    }

    public function maintenanceRecords()
    {
        return $this->hasMany(MaintenanceRecord::class, 'maintainer_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }


}