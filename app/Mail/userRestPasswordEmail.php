<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class userRestPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    public $first_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code,$first_name)
    {
        $this->code = $code;
        $this->first_name = $first_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user-rest-password');
    }
}
