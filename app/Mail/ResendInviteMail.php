<?php

namespace App\Mail;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResendInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct($link, $token)
    {
        $this->link = $link;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: Auth::user()->email,
            subject: 'Resend Invite Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.invite_link',
            with: ([
                'user' => Auth::user(),
                'name' => Auth::user()->name,
                'title' => 'Invite Link',
                'description' => 'Click the link below to Open the Door.',
                'link' => $this->link,
                'token' => $this->token,
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
