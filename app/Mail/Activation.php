<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Activation extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;

    /**
     * Edit constructor.
     * @param $mail
     */
    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Код активації сайту Khanifest')
            ->view('mails.activation', [
                'nickname' => $this->mail['nickname'],
                'id' => $this->mail['id'],
                'confirmation_code' => $this->mail['confirmation_code'],
            ]);
    }
}
