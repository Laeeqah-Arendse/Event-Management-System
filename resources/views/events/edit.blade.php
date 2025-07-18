@extends('layouts.app')

@section('content')
<div class="container max-w-lg mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6">Edit Event</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2" value="{{ old('title', $event->title) }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="date" class="block font-semibold mb-1">Date</label>
            <input type="date" name="date" id="date" class="w-full border rounded px-3 py-2" value="{{ old('date', $event->date->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-4">
            <label for="location" class="block font-semibold mb-1">Location</label>
            <input type="text" name="location" id="location" class="w-full border rounded px-3 py-2" value="{{ old('location', $event->location) }}" required>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded">
                Update Event
            </button>
            <a href="{{ route('events.index') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
