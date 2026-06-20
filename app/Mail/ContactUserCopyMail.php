<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUserCopyMail extends Mailable
{
    public function __construct(public array $data) {}

    public function build()
    {
        return $this->subject('Копия вашего обращения')
            ->view('emails.user')
            ->with('data', $this->data);
    }
}
