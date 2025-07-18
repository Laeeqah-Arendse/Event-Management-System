@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-lg">

    <h1 class="text-3xl font-bold mb-4">{{ $event->title }}</h1>

    <p class="mb-2"><strong>Description:</strong> {{ $event->description }}</p>
    <p class="mb-2"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
    <p class="mb-2"><strong>Location:</strong> {{ $event->location }}</p>

    <div class="mt-6 flex space-x-8">
        <a href="{{ route('events.index') }}" class="px-3 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">Back to Events</a>

        @can('update', $event)
            <a href="{{ route('events.edit', $event) }}" class="px-3 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">Edit Event</a>

        @endcan
    </div>
</div>
@endsection
