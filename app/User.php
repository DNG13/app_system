<?php

namespace App;

use App\Models\Avatar;
use App\Models\Profile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fb', 'email', 'password', 'conformation_code', 'conformed_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function avatar()
    {
        return $this->hasOne(Avatar::class, 'user_id', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
}

class CustomResetPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Сброс пароля')
            ->line('Вы получили это письмо, потому что мы получили запрос о сбросе пароля.')
            ->line('Нажмите на кнопку ниже для смены пароля.')
            ->action('Сброс пароля', url(config('app.url') . route('password.reset', $this->token, false)))
            ->line('Если вы не делали запрос о сбросе пароля, проигнорируйте это сообщение.');
    }
}
