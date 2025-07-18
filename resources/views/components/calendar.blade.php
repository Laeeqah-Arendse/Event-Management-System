@props(['events'])

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>

<div id="calendar" class="rounded-md shadow-inner" style="height: 400px; max-width: 100%;"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 400,
        events: [
            @foreach($events as $event)
            {
                title: "{{ addslashes($event->title) }}",
                start: "{{ \Carbon\Carbon::parse($event->date)->toDateString() }}",
                url: "{{ route('events.show', $event) }}",
            },
            @endforeach
        ],
        eventClick: function(info) {
            if(info.event.url) {
                window.location.href = info.event.url;
                info.jsEvent.preventDefault();
            }
        }
    });

    calendar.render();
});
</script>
