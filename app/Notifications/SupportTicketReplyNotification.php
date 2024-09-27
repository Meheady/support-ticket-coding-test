<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupportTicketReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    protected $ticket;
    protected $reply;
    public function __construct($ticket, $reply)
    {
        $this->ticket = $ticket;
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Reply on Your Ticket: #'.$this->ticket->ticket_no)
            ->line('Subject: '. $this->ticket->subject)
            ->line('Response: '. $this->reply->response)
            ->action('View Reply', route( $this->ticket->user->type =='admin'?'admin.tickets.view':'customer.tickets.view', $this->ticket->id));
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
            'message' => $this->reply->response,
            'url' => route( $this->ticket->user->type =='admin'?'admin.tickets.view':'customer.tickets.view', $this->ticket->id)
        ];
    }
}
