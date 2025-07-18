<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\LAEvent;

class LAAttendee extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'user_id', 'status']; // add more as needed

    public function event()
{
    return $this->belongsTo(LAEvent::class, 'l_a_event_id');
}


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
