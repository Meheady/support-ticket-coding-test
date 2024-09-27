<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\SupportTicketOpenedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
class TicketController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        $departmentId = $request->get('department_id');

        $userId = Auth::id();
        $routeName = Route::currentRouteName();
        $cacheKey = 'tickets_cache_' . $status . '_' . $departmentId . '_' . $routeName . '_' . $userId;

        $departments = Cache::remember('departments', 600, function () {
            return Department::where('status', 1)->get();
        });

        $tickets = Cache::remember($cacheKey, 86400, function () use ($status, $departmentId, $routeName, $userId) {
            $query = Ticket::latest();

            if ($status) {
                $query->where('status', $status);
            }
            if ($departmentId) {
                $query->where('department_id', $departmentId);
            }
            if ($routeName == 'customer.tickets') {
                $query->where('user_id', $userId);
            }

            return $query->get();
        });

        if ($routeName == 'customer.tickets') {
            return view('customer.ticket.view-all', compact('tickets', 'departments'));
        } elseif ($routeName == 'admin.tickets') {
            return view('admin.ticket.view-all', compact('tickets', 'departments'));
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
        auth()->user()->unreadNotifications->where('data.ticket_id', $id)
            ->markAsRead();
        if (Route::currentRouteName() == 'admin.tickets.view') {
            return view('admin.ticket.view-ticket', compact('ticket'));
        } else {
            return view('customer.ticket.view-ticket', compact('ticket'));
        }
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
                $imagePath = 'storage/' . $filePath;
            }
            $ticket = Ticket::create([
                'user_id' => auth()->id(),
                'department_id' => $request->department_id,
                'ticket_no' => rand(100000, 999999),
                'subject' => $request->subject,
                'description' => $request->description,
                'attachment' => $imagePath,
                'priority' => $request->priority,
                'status' => Ticket::STATUS_OPEN,
            ]);

            $admins = User::where('type', 'admin')->get();

            Notification::send($admins, new SupportTicketOpenedNotification($ticket));

            return redirect()->route('customer.tickets.view', $ticket->id)
                ->with('success', 'Your ticket has been created successfully.');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
