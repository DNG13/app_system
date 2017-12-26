<?php

namespace App\Actions\AppPress;

use App\Abstracts\Action;
use App\Models\AppPress;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class UpdateAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request, $id)
    {
        $press  = AppPress::where('id', $id)->first();
        $press->type_id = $request->get('type_id');
        $press->media_name = $request->get('media_name');
        $press->contact_name = $request->get('contact_name');
        $press->phone = $request->get('phone');
        $press->equipment = $request->get('equipment');
        $press->portfolio_link = $request->get('portfolio_link');
        $press->city = $request->get('city');
        $press->camera = $request->get('camera');

        if($request->get('status') && Auth::user()->isAdmin()) {
            if($press->status != $request->get('status')) {
                    $user =  User::where('id', $press->user_id)->first();
                    $mail['email'] = $user->email;
                    $mail['nickname'] = $user->profile->nickname;
                    $mail['title'] = $press->media_name;
                    $mail['page'] = '/press/'. $press->id;
                    $mail['status'] = $request->get('status');
                    Mail::send('mails.status',  $mail , function($message) use ( $mail ){
                        $message->to( $mail['email']);
                        $message->subject('Заявка ' .$mail['title'] . ' изменена');
                    });
                }
            $press->status = $request->get('status');
        }
        $members = [];
        foreach($request->input('members') as  $key => $value) {
            $members["member{$key}"] = $value;
        }
        $press->members_count = count($members);
        $press->members = json_encode($members);
        $press->social_links = json_encode($request['social_links']);
        $press->save();

        if (!Auth::user()->isAdmin()) {
            $mail['nickname'] = 'Admin';
            $mail['email'] = 'khanifest.mail@gmail.com';
            $mail['title'] = $press->media_name;
            $mail['page'] = '/press/'. $press->id;
            Mail::send('mails.edit', $mail, function ($message) use ($mail) {
                $message->to($mail['email']);
                $message->subject('Заявка ' .$mail['title'] . ' изменена');
            });
        }

        return redirect('press')->with('success', "Ваша заявка успешно изменена.");
    }
}