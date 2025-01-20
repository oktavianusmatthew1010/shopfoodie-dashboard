<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $apiKey = 'AIzaSyDT4Kx_ZjLoqRRg1E6ULKNMt6mIZGsaJqQ';
        $calendarId = 'en.singapore#holiday@group.v.calendar.google.com';

        // Google Calendar API URL
        $url = "https://www.googleapis.com/calendar/v3/calendars/" . urlencode($calendarId) . "/events?key=" . $apiKey;

        // Fetch data from Google Calendar API
        $response = Http::get($url);

        if ($response->successful()) {
            $events = $response->json()['items'];

            // Format events for FullCalendar
            $formattedEvents = array_map(function ($event) {
                return [
                    'title' => $event['summary'],
                    'start' => $event['start']['date'],
                    'end' => isset($event['end']['date']) ? $event['end']['date'] : null,
                ];
            }, $events);

            // Pass events to the view
            return view('panel.calendar', ['events' => json_encode($formattedEvents)]);
        }

        // Handle API failure
        return view('panel.calendar', ['events' => json_encode([])]);
   
        //return view('default.calendar', ['events' => json_encode($events)]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ]);

        // Save the event to the database
        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event added successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
