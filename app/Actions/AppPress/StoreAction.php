<?php

namespace App\Actions\AppPress;

use App\User;
use App\Abstracts\Action;
use App\Models\AppPress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class StoreAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request)
    {
        $press = new AppPress();
        $press->type_id = $request->get('type_id');
        $press->media_name = $request->get('media_name');
        $press->contact_name = $request->get('contact_name');
        $press->phone = $request->get('phone');
        $press->members_count = $request->get('members_count');
        $press->equipment = $request->get('equipment');
        $press->portfolio_link = $request->get('portfolio_link');
        $press->city = $request->get('city');
        $press->camera = $request->get('camera');
        $press->user_id = Auth::user()->id;
        $press->status = 'В обработке';
        $press->social_links = json_encode($request['social_links']);
        $press->save();

        $user = User::find( Auth::user()->id);
        $mail['email'] = $user->email;
        $mail['nickname'] = $user->profile->nickname;
        $mail['title'] = $press->media_name;
        $mail['page'] = '/press/'. $press->id;
        Mail::send('mails.application',  $mail , function($message) use ( $mail ) {
            $message->to( $mail['email']);
            $message->subject('Ваша заявка успешно отправлена');
        });

        return redirect('press')->with('success', "Ваша заявка успешно отправлена.");
    }
}