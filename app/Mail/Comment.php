<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Comment extends Mailable
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
        return $this->subject('Добавлен комментарий к заяке '. $this->mail['title'] . ' ' .$this->mail['page'])
            ->from($this->mail['from'])
            ->view('mails.comment', [
                'nickname' => $this->mail['nickname'],
                'title' => $this->mail['title'],
                'page' => $this->mail['page'],
                'text' => $this->mail['text'],
            ]);
    }
}
