<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Auth;

class AccessNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $guest_name;
    public $user_name;

    /**
     * Create a new message instance.
     */
    public function __construct($guest_name, $user_name)
    {
        $this->guest_name = $guest_name;
        $this->user_name = $user_name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'door.system@mail.com',
            subject: 'Access Notification Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.access_notification',
            with: ([
                'title' => 'Access Notification Mail',
                'description' => 'A Guest has opened the Door',
                'guest_name' => $this->guest_name,
                'user_name' => $this->user_name,
            ]),
            
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
