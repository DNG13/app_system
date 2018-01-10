<?php

namespace App\Actions\Register;

use App\Abstracts\Action;
use App\Jobs\SendActivationEmailJob;

class UserReactivationSendAction extends Action
{

    public function __construct()
    {

    }

    public function run($user)
    {
        $confirmation = ['code' => str_random(30), 'created' => gmdate('Y-m-d H:i:s'), 'type' => 'confirm'];
        $user->confirmation_code = $confirmation;
        $user->save();

        $mail['confirmation_code'] = $confirmation['code'];
        $mail['id'] = $user['id'];
        $mail['nickname'] = $user['nickname'];
        $mail['email'] = $user->email;

        SendActivationEmailJob::dispatch($mail)
            ->delay(now()->addSeconds(2));
    }
}