<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuggestionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $suggestion;

    public function __construct($suggestion)
    {
        $this->suggestion = $suggestion;
    }

    public function build()
    {
        return $this->subject('Pesan Baru dari Website')
            ->view('emails.suggestion');
    }
}
