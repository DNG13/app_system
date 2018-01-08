<?php

namespace App\Actions\AppCosplay;

use App\Abstracts\Action;
use App\Mail\Edit;
use App\Mail\Status;
use App\Models\AppCosplay;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $cosplays->group_nick = $request->get('group_nick');
        $cosplays->fandom = $request->get('fandom');
        $cosplays->length = $request->get('length');
        $cosplays->city = $request->get('city');
        $cosplays->description = $request->get('description');
        $cosplays->prev_part = $request->get('prev_part');
        $cosplays->props = $request->get('props');
        $cosplays->comment = $request->get('comment');

        if($request->get('status') && Auth::user()->isAdmin()) {
            if($cosplays->status != $request->get('status')) {
                    $user =  User::where('id', $cosplays->user_id)->first();
                    $mail['nickname'] = $user->profile->nickname;
                    $mail['title'] = $cosplays->title;
                    $mail['email'] = $user->email;
                    $mail['page'] ='/cosplay/'. $cosplays->id;
                    $mail['status'] = $request->get('status');
                    Mail::to($mail['email'])->send(new Status($mail));
                }
            $cosplays->status = $request->get('status');
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
            $mail['email'] = 'khanifest+show@gmail.com';
            $mail['title'] = $cosplays->title;
            $mail['page'] = '/cosplay/'. $cosplays->id;
            Mail::to($mail['email'])->send(new Edit($mail));
        }

        return redirect('cosplay')->with('success', "Ваша заявка успешно изменена.");
    }
}