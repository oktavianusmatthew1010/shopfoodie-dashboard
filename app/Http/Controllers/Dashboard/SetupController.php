<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\TicketAction;
use App\Http\Controllers\Controller;
use App\Models\UserSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SetupController extends Controller
{
    public function list()
    {
        $user = auth()->user();

        $items = UserSetup::all();

        return view('panel.setup.list', compact('items'));
    }

    public function newSetup()
    {
        return view('panel.setup.list');
    }

    public function newTicketSend(Request $request): void
    {
        if (! $user = Auth::user()) {
            return;
        }

        $support = $user->supportRequests()->create([
            'ticket_id' => Str::upper(Str::random(10)),
            'priority'  => $request->priority,

            'category'  => $request->category,
            'subject'   => $request->subject,
        ]);

        TicketAction::ticket($support)
            ->fromUser()
            ->new($request->message)
            ->send();
    }

    public function viewTicket($ticket_id)
    {
        $ticket = UserSetup::where('id', $ticket_id)->firstOrFail();

        if ($ticket->user_id == Auth::id() or Auth::user()->isAdmin()) {
            return view('panel.setup.view', compact('ticket'));
        } else {
            return view('panel.setup.view', compact('ticket'));
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
