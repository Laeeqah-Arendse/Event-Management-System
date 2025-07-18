<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\LAEvent;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Include this if using role-based access
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Role-check helpers
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isOrganizer()
    {
        return $this->role === 'organizer';
    }

    // Optional relationships
     public function events()
{
    return $this->hasMany(LAEvent::class, 'user_id');
}


    // public function registrations()
    // {
    //     return $this->hasMany(LAAttendee::class);
    // }
}
