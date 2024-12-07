<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class TestMail extends Mailable
{
    public function build()
    {
        return $this->view('emails.test')
                    ->subject('Test Email');
    }
} 