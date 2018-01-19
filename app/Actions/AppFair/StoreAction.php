<?php

namespace App\Actions\AppFair;

use App\User;
use App\Abstracts\Action;
use App\Jobs\SendApplicationEmailJob;
use App\Jobs\SendForAdminNewAppEmailJob;
use App\Models\AppFair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request)
    {
        $fair = new AppFair();
        $fair->type_id = $request->get('type_id');
        $fair->group_nick = $request->get('group_nick');
        $fair->contact_name = $request->get('contact_name');
        $fair->phone = $request->get('phone');
        $fair->social_link = $request->get('social_link');
        $fair->group_link = $request->get('group_link');
        $fair->city = $request->get('city');
        $fair->payment_type = $request->get('payment_type');
        $fair->description = $request->get('description');
        $fair->electrics = $request->get('electrics');
        $fair->user_id = Auth::user()->id;
        $fair->status = 'В обработке';
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

        $user = User::find( Auth::user()->id);
        $mail['email'] = $user->email;
        $mail['nickname'] = $user->profile->nickname;
        $mail['title'] = $fair->group_nick;
        $mail['page'] = '/fair/'. $fair->id;
        SendApplicationEmailJob::dispatch($mail)
            ->delay(now()->addSeconds(2));
        $mail['email'] = 'khanifest+fair@gmail.com';
        $mail['nickname'] = 'Admin';
        $mail['from'] = Auth::user()->email;
        SendForAdminNewAppEmailJob::dispatch($mail)
            ->delay(now()->addSeconds(2));

        return redirect('fair')->with('success', "Ваша заявка успешно отправлена.");
    }
}