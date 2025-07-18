@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">All Events</h1>

	<div class="d-flex justify-content-end mb-3">
     <a href="{{ route('events.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create Event</a>
    </a>
</div>


    {{-- Show success or message alerts --}}
    @if(session('success'))
        <script>alert("{{ session('success') }}");</script>
    @endif
    @if(session('message'))
        <script>alert("{{ session('message') }}");</script>
    @endif

    {{-- Calendar component --}}
    <div id="calendar" class="mb-8"></div>

    <ul class="space-y-6">
        @foreach ($events as $event)
            <li class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
                <p class="mt-1">{{ $event->description }}</p>
                <p class="text-sm text-gray-600 mt-1">
                    {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }} at {{ $event->location }}
                </p>

                <div class="mt-4 flex flex-wrap gap-3 items-center">
                    <a href="{{ route('events.show', $event) }}"
                       class="px-4 py-2 bg-blue-400 text-blue-700 rounded hover:bg-blue-200 transition">
                        View
                    </a>

                    <form method="POST" action="{{ route('events.register', $event) }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 bg-green-100 text-green-700 rounded hover:bg-green-200 transition">
                            Register
                        </button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection

@section('scripts')
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.css" rel="stylesheet" />

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                contentHeight: 'auto',
                expandRows: true,
                events: [
                    @foreach($events as $event)
                    {
                        title: {!! json_encode($event->title) !!},
                        start: "{{ \Carbon\Carbon::parse($event->date)->toDateString() }}",
                        url: "{{ route('events.show', $event) }}"
                    },
                    @endforeach
                ],
                eventClick: function(info) {
                    if (info.event.url) {
                        window.location.href = info.event.url;
                        info.jsEvent.preventDefault();
                    }
                }
            });

            calendar.render();
        });
    </script>
@endsection
