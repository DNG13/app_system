<?php

namespace App\Actions\AppCosplay;

use App\User;
use App\Abstracts\Action;
use App\Mail\Application;
use App\Mail\ForAdminNewApp;
use App\Models\AppCosplay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StoreAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request)
    {
        $cosplays = new AppCosplay();
        $cosplays->type_id = $request->get('type_id');
        $cosplays->title = $request->get('title');
        $cosplays->group_nick = $request->get('group_nick');
        $cosplays->fandom = $request->get('fandom');
        $cosplays->length = $request->get('length');
        $cosplays->city = $request->get('city');
        $cosplays->description = $request->get('description');
        $cosplays->prev_part = $request->get('prev_part');
        $cosplays->props = $request->get('props');
        $cosplays->comment = $request->get('comment');
        $cosplays->user_id = Auth::user()->id;
        $cosplays->status = 'В обработке';

        $members = [];
        foreach($request->input('members') as  $key => $value) {
            $members["member{$key}"] = $value;
        }
        $cosplays->members_count = count($members);
        $cosplays->members = json_encode($members);
        $cosplays->save();

        $user = User::find( Auth::user()->id);
        $mail['nickname'] = $user->profile->nickname;
        $mail['title'] = $cosplays->title;
        $mail['email'] = $user->email;
        $mail['page'] = '/cosplay/'. $cosplays->id;
        Mail::to($mail['email'])->send(new Application($mail));
        $mail['email'] = 'khanifest+show@gmail.com';
        $mail['nickname'] = 'Admin';
        Mail::to($mail['email'])->send(new ForAdminNewApp($mail));

        return redirect('cosplay')->with('success', "Ваша заявка успешно отправлена.");
    }
}