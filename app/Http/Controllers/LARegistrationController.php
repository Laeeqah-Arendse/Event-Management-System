<?php

namespace App\Http\Controllers;

use App\Models\LARegistration;
use App\Models\LAEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LARegistrationController extends Controller
{
    public function store($id)
    {
        $event = LAEvent::findOrFail($id);

        // Check if user already registered
        $exists = LARegistration::where('event_id', $id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already registered for this event.');
        }

        LARegistration::create([
            'user_id' => Auth::id(),
            'event_id' => $id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Registered for event successfully!');
    }
}
