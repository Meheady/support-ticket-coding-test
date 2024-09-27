<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest();
        if (Route::currentRouteName() == 'customer.tickets') {
            $tickets = $tickets->where('user_id', Auth::id())->get();
            return view('customer.ticket.view-all',compact('tickets'));
        }elseif (Route::currentRouteName() == 'admin.tickets') {
           $tickets = $tickets->get();
            return view('admin.ticket.view-all',compact('tickets'));
        }
    }

    public function createTicket()
    {
        $departments = Department::where('status', 1)->get();
        $priority = Ticket::getPriorityOptions();
        return view('customer.ticket.create', compact('departments', 'priority'));
    }

    public function viewTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('customer.ticket.view-ticket', compact('ticket'));
    }

    public function storeTicket(Request $request)
    {

        try {

            $request->validate([
                'department_id' => 'required',
                'priority' => 'required',
                'subject' => 'required',
                'description' => 'required',
                'attachment' => 'nullable|mimes:jpg,jpeg,png',
            ]);

            $imagePath = "";
            if ($request->hasFile('attachment')) {
                $filePath = $request->file('attachment')->store('ticket_attachment', 'public');
                $imagePath = 'storage/'.$filePath;
            }
            $ticket = Ticket::create([
                'user_id' => auth()->id(),
                'department_id' => $request->department_id,
                'ticket_no' => rand(100000,999999),
                'subject' => $request->subject,
                'description' => $request->description,
                'attachment' => $imagePath,
                'priority' => $request->priority,
                'status' => Ticket::STATUS_OPEN,
            ]);

            return redirect()->route('customer.tickets.view', $ticket->id)
                ->with('success', 'Your ticket has been created successfully.');
        }
        catch (\Exception $e) {
            return redirect()->route('customer.tickets.create');
        }
    }
}
