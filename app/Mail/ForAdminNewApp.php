<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForAdminNewApp extends Mailable
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
        return $this->subject('Заявка '. $this->mail['title'] .' успешно отправлена ' . $this->mail['page'])
            ->from($this->mail['from'])
            ->view('mails.forAdminNewApp', [
                'nickname' => $this->mail['nickname'],
                'title' => $this->mail['title'],
                'page' => $this->mail['page'],
            ]);
    }
}
