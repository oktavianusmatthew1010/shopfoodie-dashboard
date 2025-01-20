<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\TicketAction;
use App\Http\Controllers\Controller;
use App\Models\UserSupport;
use App\Models\UserSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
class SupportController extends Controller
{
    public function list()
    {
        $user = auth()->user();

        $items =  UserSupport::all() ;

        return view('panel.support.list', compact('items'));
    }

    public function newTicket()
    {
        return view('panel.support.new');
    }
    function getRandomDate($datestart, $enddate) {
        // Convert the dates to Carbon instances
        $startDate = Carbon::parse($datestart);
        $endDate = Carbon::parse($enddate);
    
        // Ensure start date is not after end date
        if ($startDate->greaterThan($endDate)) {
            throw new Exception("Start date must be earlier than end date.");
        }
    
        // Generate a random timestamp between the start and end timestamps
        $randomTimestamp = rand($startDate->timestamp, $endDate->timestamp);
    
        // Convert the timestamp back to a date
        return Carbon::createFromTimestamp($randomTimestamp);
    }
    public function newTicketSend(Request $request): void
{
    if (! $user = Auth::user()) {
        return;
    }

    // Get random date function (Make sure this is in your controller or a helper)
    function getRandomDate($datestart, $enddate) {
        $startDate = Carbon::parse($datestart);
        $endDate = Carbon::parse($enddate);

        if ($startDate->greaterThan($endDate)) {
            throw new Exception("Start date must be earlier than end date.");
        }

        $randomTimestamp = rand($startDate->timestamp, $endDate->timestamp);

        return Carbon::createFromTimestamp($randomTimestamp);
    }

    // Loop to generate multiple entries based on frequency
    for ($i = 0; $i < $request->frequency; $i++) {

        // Generate a random date for each loop
        $randomDate = getRandomDate($request->calendar_start, $request->calendar_end);

        // Prepare the request payload for the Node.js API
        // $payload = [
        //     'promptText' => $request->subject." for ".$request->platform." also for the suggestion from Google Trends",
        //     'imagePrompt' => $request->category,
        // ];
        $promptText = "simple content ".$request->subject." with menu ".$request->description."for chinese new year 2025 and post it for".$request->platform." please make less then 50 words and simple , make it Lower temperature to make AI model more factual and less creative";
        $imagePrompt = "create image ".$request->subject."  and put chinese new year 2025 as background";
        
        

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4', // Use "gemini-1.5-flash" if available
            'messages' => [
                ['role' => 'assistant', 'content' => 'As a Pdf AI, you will now play a character and respond as that character (You will never break character). Your name is Image Generator but do not introduce by yourself as well as greetings.'],
                ['role' => 'user', 'content' => $promptText],
            ],
        ]);

        $data=$response->json();
        
            $generatedText = $data['choices'][0]['message']['content'];

            $imageResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ])->post('https://api.openai.com/v1/images/generations', [
                'prompt' => $imagePrompt,
                'n' => 1,
                'size' => '256x256',
            ]);
            $uploadedImageFullPath = storage_path('app/public/uploads/19719709.jpg');
            
            $imageUrl = $imageResponse->json()['data'][0]['url'];

       // $backgroundImage = Image::make($imageUrl);

            // Open the uploaded image
            
        // Call the Node.js API
        #$response = Http::post('http://localhost:3000/generate-content', $payload);
        #Log::info($response);
        #$data = $response->json(); // Convert JSON response to associative array
        $text = $data['text'] ?? null; // Get 'text' field
        $image = $data['image'] ?? null; // Get 'image' field

        // Insert into database
        DB::table('user_setup')->insert([
            'userid' => 2, // Static value or dynamic from your logic
            'description' => $generatedText,
            'campaign_type' => $request->platform,
            'campaign_name' => $request->subject,
            'posted' => $randomDate, // Store the random date here
            'images' => $imageUrl,
        ]);
    }

    // Create support ticket after loop is done
    $support = $user->supportRequests()->create([
        'ticket_id' => Str::upper(Str::random(10)),
        'priority'  => $request->priority,
        'category'  => $request->category,
        'subject'   => $request->subject,
        'duration'  => $request->duration,
        'frequency' => $request->frequency,
        'platform'  => $request->platform,
        'target'    => $request->target,
        'startdate' => $request->calendar_start,
        'enddate'   => $request->calendar_end,
    ]);

    TicketAction::ticket($support)
        ->fromUser()
        ->new($request->message)
        ->send();
}


    public function viewTicket($ticket_id)
    {
        $ticket = UserSupport::where('ticket_id', $ticket_id)->firstOrFail();

        if ($ticket->user_id == Auth::id() or Auth::user()->isAdmin()) {
            return view('panel.support.view', compact('ticket'));
        } else {
            return view('panel.support.view', compact('ticket'));
        }
    }

    public function viewTicketSendMessage(Request $request): void
    {
        if (! $user = Auth::user()) {
            return;
        }

        TicketAction::ticket($request->input('ticket_id'))
            ->fromAdminIfTrue($user->isAdmin())
            ->answer($request->input('message'))
            ->send();
    }
}
