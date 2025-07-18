<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LARegistration extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id', 'status'];

    public function event()
    {
        return $this->belongsTo(LAEvent::class, 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
