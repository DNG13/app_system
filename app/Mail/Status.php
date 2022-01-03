<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Status extends Mailable
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
        return $this->subject('Зміна статусу заявки ' . $this->mail['title'])
            ->view('mails.status', [
                'nickname' => $this->mail['nickname'],
                'title' => $this->mail['title'],
                'page' => $this->mail['page'],
                'status' => $this->mail['status'],
            ]);
    }
}
