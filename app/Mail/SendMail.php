<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $code)
    {
        $this->email = $email;
        $this->code = $code;

        $this->subject("Processus de réinitialisation du mot de passe");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@babaata.org')->markdown('emails.password.reset', [
            'email' => $this->email,
            'code' => $this->code
        ]);
    }
}
