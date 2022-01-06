<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Application extends Model
{
    const APP_STATUS_IN_PROCESSING = 'processing';
    const APP_STATUS_WAIT_USER = 'wait_user';
    const APP_STATUS_ACCEPTED = 'accepted';
    const APP_STATUS_REJECTED = 'rejected';
    const APP_STATUS_CHANGED = 'changed';

    protected $statusText = [
        self::APP_STATUS_IN_PROCESSING => 'В обробці',
        self::APP_STATUS_WAIT_USER => 'Очікує на відповідь користувача',
        self::APP_STATUS_ACCEPTED => 'Прийнята',
        self::APP_STATUS_REJECTED => 'Відхилена',
        self::APP_STATUS_CHANGED => 'Змінена'
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }

    public function type()
    {
        return $this->hasOne(AppType::class, 'id', 'type_id');
    }

    public function getStatusText()
    {
        return $this->statusText[$this->status] ?? 'unknown';
    }
}
