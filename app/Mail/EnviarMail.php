<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class EnviarMail extends Mailable
{
    use Queueable, SerializesModels;


    public $subject = 'PRODUCTOS CADUCADOS';
    public $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        //$this->msg = $msg;
        //$this->msg = $this->view('Mail.index');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('Mail.index');
        //return $this->msg;
    }
}
