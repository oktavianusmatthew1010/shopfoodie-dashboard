@extends('panel.layout.app', ['disable_tblr' => true])
@section('title', __('Public Holiday'))
@section('titlebar_actions')
        <x-button href="{{ route('dashboard.setup.new') }}">
            {{ __('Create New Public Holiday') }}
            <x-tabler-plus class="size-4" />
        </x-button>
    
@endsection
@section('content')
<div id="calendar"></div>
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
