<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendLinkTokenReset extends Mailable
{
    use Queueable;
    use SerializesModels;

    public string $name;
    public string $email;
    public string $token;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->token = $data['token'];
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recuperação de senha.',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reset-link',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'token' => $this->token,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
