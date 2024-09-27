<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupportTicketOpenedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    protected $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Ticket Opened: #'.$this->ticket->ticket_no .'-'.$this->ticket->subject)
            ->line('A new ticket has been opened by ' . $this->ticket->user->name)
            ->line('Message ' . $this->ticket->description)
            ->action('View Ticket', route('admin.tickets.view', $this->ticket->id))
            ->line('Please respond to the ticket.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'subject' => $this->ticket->subject,
            'message' => $this->ticket->description,
            'url' => route('admin.tickets.view', $this->ticket->id),
        ];
    }
}
