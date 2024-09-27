<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Http\Request;

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

        TicketResponse::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'response' => $request->response,
            'attachment' => $imagePath,
        ]);

        $ticketStatus = Ticket::STATUS_REPLY;

        if ($request->has('status')) {
            $ticketStatus = request('status');
        }

        $ticket->update(['status' => Ticket::STATUS_REPLY]);
        return redirect()->back()->with('success', 'Your reply has been sent.');
    }

}
