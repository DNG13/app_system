<?php

namespace App\Actions\AppCosplay;

use App\Abstracts\Action;
use App\Models\AppCosplay;
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
        $cosplays = AppCosplay::where('id', $id)->first();
        $cosplays->type_id = $request->get('type_id');
        $cosplays->title = $request->get('title');
        $cosplays->fandom = $request->get('fandom');
        $cosplays->length = $request->get('length');
        $cosplays->city = $request->get('city');
        $cosplays->description = $request->get('description');
        $cosplays->prev_part = $request->get('prev_part');
        $cosplays->comment = $request->get('comment');

        if($request->get('status')) {
            if (Auth::user()->isAdmin()) {
                if($cosplays->status != $request->get('status')) {
                    $user =  User::where('id', $cosplays->user_id)->first();
                    $mail['nickname'] = $user->profile->nickname;
                    $mail['title'] = $cosplays->title;
                    $mail['email'] = $user->email;
                    $mail['page'] ='/cosplay/'. $cosplays->id;
                    $mail['status'] = $request->get('status');
                    Mail::send('mails.status',  $mail , function($message) use ( $mail ){
                        $message->to( $mail['email']);
                        $message->subject('Изминение статуса завки');
                    });
                }
                $cosplays->status = $request->get('status');
            }
        }
        $members = [];
        foreach($request->input('members') as  $key => $value) {
            $members["member{$key}"] = $value;
        }
        $cosplays->members_count = count($members);
        $cosplays->members = json_encode($members);
        $cosplays->save();
        if (!Auth::user()->isAdmin()) {
            $mail['nickname'] = 'Admin';
            $mail['email'] = 'khanifest.mail@gmail.com';
            $mail['title'] = $cosplays->title;
            $mail['page'] = '/cosplay/'. $cosplays->id;
            Mail::send('mails.edit', $mail, function ($message) use ($mail) {
                $message->to($mail['email']);
                $message->subject('Заявка ' .$mail['title'] . ' изменена');
            });
        }

        return redirect('cosplay')->with('success', "Ваша заявка успешно изменена.");
    }
}