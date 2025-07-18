<?php

namespace App\Http\Controllers;

use App\Models\LAEvent;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use Illuminate\Support\Facades\Auth;

class LAEventController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(LAEvent::class, 'event');
    }

    public function register(LAEvent $event)
    {
        $userId = auth()->id();

        
        if ($event->attendees()->where('user_id', $userId)->exists()) {
            return back()->with('message', 'You are already registered for this event.');
        }

        
        $event->attendees()->create([
            'user_id' => $userId,
            // add other fields if needed
        ]);

        return back()->with('success', 'You have successfully registered.');
    }

    public function index()
    {
        $events = LAEvent::with('organizer')->latest()->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(StoreEventRequest $request)
    {
        Auth::user()->events()->create($request->validated());
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(LAEvent $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(LAEvent $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(StoreEventRequest $request, LAEvent $event)
    {
        $event->update($request->validated());
        return redirect()->route('events.index')->with('success', 'Event updated.');
    }

    public function destroy(LAEvent $event)
    {
        $event->delete();
        return back()->with('success', 'Event deleted.');
    }
} 
