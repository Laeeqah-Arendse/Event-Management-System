<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\LAAttendee;

class LAEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'date', 'location', 'status', 'user_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendees()
    {
        return $this->hasMany(LAAttendee::class, 'l_a_event_id');
    }
}
