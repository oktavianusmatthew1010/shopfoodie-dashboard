@extends('panel.layout.app', ['disable_tblr' => true])
@section('title', __('Public Holiday'))
@section('titlebar_actions')
        <x-button href="{{ route('dashboard.setup.new') }}">
            {{ __('Create New Public Holiday') }}
            <x-tabler-plus class="size-4" />
        </x-button>
    
@endsection
@section('content')
<h1>Event Calendar</h1>

    <!-- Display Success Message -->
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <!-- Add Event Form -->
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <label for="title">Event Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>

        <label for="start_time">Start Time:</label>
        <input type="datetime-local" id="start_time" name="start_time" required><br>

        <label for="end_time">End Time:</label>
        <input type="datetime-local" id="end_time" name="end_time" required><br>

        <button type="submit">Add Event</button>
    </form>

    <!-- Display Events -->
    <h2>Events List</h2>
    <ul>
        @foreach($events as $event)
            <li>
                <strong>{{ $event->title }}</strong>: {{ $event->start_time }} to {{ $event->end_time }}
            </li>
        @endforeach
    </ul>
@endsection
@push('script')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: {!! $events !!},
            });
            calendar.render();
        });
    </script>
@endpush
