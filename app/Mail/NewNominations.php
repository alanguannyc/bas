<?php

namespace App\Mail;
use App\Nomination;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewNominations extends Mailable
{
    use Queueable, SerializesModels;
    public $nomination;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Nomination $nomination)
    {
        $this->nomination = $nomination;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.nomination.new');
    }
}
