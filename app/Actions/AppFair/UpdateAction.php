<?php

namespace App\Actions\AppFair;

use App\Abstracts\Action;
use App\Jobs\SendEditEmailJob;
use App\Jobs\SendStatusEmailJob;
use App\Models\AppFair;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request, $id)
    {
        $fair = AppFair::where('id', $id)->first();
        $fair->type_id = $request->get('type_id');
        $fair->group_nick = $request->get('group_nick');
        $fair->contact_name = $request->get('contact_name');
        $fair->city = $request->get('city');
        $fair->phone = $request->get('phone');
        $fair->social_link = $request->get('social_link');
        $fair->group_link = $request->get('group_link');
        $fair->payment_type = $request->get('payment_type');
        $fair->description = $request->get('description');
        $fair->electrics = $request->get('electrics');

        if($request->get('status') && Auth::user()->isAdmin()) {
            if($fair->status != $request->get('status')) {
                $user =  User::where('id', $fair->user_id)->first();
                $mail['email'] = $user->email;
                $mail['nickname'] = $user->profile->nickname;
                $mail['title'] = $fair->group_nick;
                $mail['page'] = '/expo/'. $fair->id;
                $mail['status'] = $request->get('status');
                SendStatusEmailJob::dispatch($mail)
                    ->delay(now()->addSeconds(2));
            }
            $fair->status = $request->get('status');
        }
        $members = [];
        foreach($request->input('members') as  $key => $value) {
            $members["member{$key}"] = $value;
        }
        $fair->members_count = count($members);
        $fair->members = json_encode($members);
        $equipment = [];
        foreach($request->input('equipment') as  $key => $value) {
            $equipment["{$key}"] = $value;
        }
        $fair->equipment = json_encode($equipment);
        $block = [];
        foreach($request->input('block') as  $key => $value) {
            $block["{$key}"] = $value;
        }
        $fair->block = json_encode($block);
        $fair->save();

        if (!Auth::user()->isAdmin()) {
            $mail['nickname'] = 'Admin';
            $mail['email'] = 'khanifest+fair@gmail.com';
            $mail['title'] = $fair->group_nick;
            $mail['page'] = '/expo/'. $fair->id;
            SendEditEmailJob::dispatch($mail)
                ->delay(now()->addSeconds(2));
        }

        return redirect('expo')->with('success', "Ваша заявка успешно изменена.");
    }
}
