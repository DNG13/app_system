<?php

namespace App\Actions\Register;

use App\Abstracts\Action;
use App\User;
use Illuminate\Http\Request;
use Mail;

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

        Mail::send('mails.activation',  ['confirmation_code' => $confirmation, 'id' => $user['id']] , function($message) use ( $user ){
            $message->to( $user ['email']);
            $message->subject('Код активации сайта Khanifest');
        });
    }
}