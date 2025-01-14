<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Auth;

class InviteLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $inviteLink;
    public $validFrom;
    public $expiresAt;

    /**
     * Create a new message instance.
     */
    public function __construct($token, $inviteLink,$validFrom, $expiresAt)
    {
        $this->token = $token;
        $this->inviteLink = $inviteLink;
        $this->validFrom = $validFrom;
        $this->expiresAt = $expiresAt;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: Auth::user()->email,
            subject: 'Invite Link Mail',
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
                'token' => $this->token,
                'inviteLink->expires_at' => $this->inviteLink->expires_at,
                'inviteLink->valid_from' => $this->inviteLink->valid_from,
                'validFrom' => $this->validFrom,
                'expiresAt' => $this->expiresAt,
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