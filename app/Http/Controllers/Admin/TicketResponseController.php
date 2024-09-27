<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\User;
use App\Notifications\SupportTicketReplyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TicketResponseController extends Controller
{
    public function reply(Request $request, $id)
    {
        $request->validate([
            'response' => 'required',
        ]);

        $ticket = Ticket::findOrFail($id);

        $imagePath = null;
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('ticket_attachment', 'public');
            $imagePath = 'storage/'.$filePath;
        }

        $reply = TicketResponse::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'response' => $request->response,
            'attachment' => $imagePath,
        ]);

        $ticketStatus = Ticket::STATUS_REPLY;

        if ($request->has('status')) {
            $ticketStatus = request('status');
        }

        if (auth()->user()->type == 'admin') {
            $ticket->user->notify(new SupportTicketReplyNotification($ticket, $reply));
        } else {
            $admins = User::where('type', 'admin')->get();

            Notification::send($admins, new SupportTicketReplyNotification($ticket, $reply));
        }

        $ticket->update(['status' => $ticketStatus]);
        return redirect()->back()->with('success', 'Your reply has been sent.');
    }

}
