@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Manage Attendees</h1>

    @foreach ($events as $event)
        <div class="bg-white p-4 mb-6 shadow rounded">
            <h2 class="font-bold text-lg">{{ $event->title }}</h2>

            <ul class="mt-2 space-y-2">
                @foreach ($event->attendees as $attendee)
                    <li class="border p-2 flex justify-between items-center">
                        <span>{{ $attendee->user->name }} ({{ $attendee->status }})</span>
                        <form method="POST" action="{{ route('attendees.update', $attendee) }}">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="border p-1">
                                <option value="pending" {{ $attendee->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $attendee->status == 'approved' ? 'selected' : '' }}>Approve</option>
                                <option value="declined" {{ $attendee->status == 'declined' ? 'selected' : '' }}>Decline</option>
                            </select>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
@endsection
