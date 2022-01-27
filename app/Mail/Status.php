<?php

namespace App\Mail;

use App\Models\AppCosplay;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Status extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;

    private $statusTranslated = [
        AppCosplay::APP_STATUS_CHANGED => 'Змінена',
        AppCosplay::APP_STATUS_WAIT_USER => 'Очікує на відповідь користувача',
        AppCosplay::APP_STATUS_IN_PROCESSING => 'В обробці',
        AppCosplay::APP_STATUS_REJECTED => 'Відхилена',
        AppCosplay::APP_STATUS_ACCEPTED => 'Прийнята',
    ];

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
                'status' => $this->getStatusTranslated($this->mail['status']),
            ]);
    }

    /**
     * @param string $status
     * @return string
     */
    private function getStatusTranslated(string $status): string
    {
        return $this->statusTranslated[$status] ?? 'Невідомо';
    }
}
