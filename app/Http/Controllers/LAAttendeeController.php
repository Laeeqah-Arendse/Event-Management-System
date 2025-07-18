<?php

namespace App\Http\Controllers;


use App\Notifications\AttendeeStatusUpdated;
use App\Models\LAAttendee;
use App\Models\LAEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LAAttendeeController extends Controller
{
    public function register(LAEvent $event)
    {
        LAAttendee::create([
            'user_id' => Auth::id(),
            'l_a_event_id' => $event->id,
        ]);

        return back()->with('success', 'Registration submitted.');
    }

    public function manage()
    {
        $events = Auth::user()->events()->with('attendees.user')->get();
        return view('attendees.manage', compact('events'));
    }

   public function update(Request $request, LAAttendee $attendee)
{
    $this->authorize('update', $attendee->event);

    $attendee->update([
        'status' => $request->input('status'),
    ]);

    $attendee->user->notify(new AttendeeStatusUpdated($attendee));

    return back()->with('success', 'Attendee updated and notified.');
}
}
