<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactOwnerMail extends Mailable
{
    public function __construct(public array $data) {}

    public function build()
    {
        return $this->subject('Новое обращение с лендинга')
            ->view('emails.owner')
            ->with('data', $this->data);
    }
}
