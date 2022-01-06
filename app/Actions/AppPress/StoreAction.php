<?php

namespace App\Actions\AppPress;

use App\User;
use App\Abstracts\Action;
use App\Jobs\SendApplicationEmailJob;
use App\Jobs\SendForAdminNewAppEmailJob;
use App\Models\AppPress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $press->social_link = $request->get('social_link');
        $press->prev_part = $request->get('prev_part');
        $press->equipment = $request->get('equipment');
        $press->portfolio_link = $request->get('portfolio_link');
        $press->city = $request->get('city');
        $press->camera = $request->get('camera');
        $press->user_id = Auth::user()->id;
        $press->status = AppPress::APP_STATUS_IN_PROCESSING;
        $members = [];
        foreach($request->input('members') as  $key => $value) {
            $members["member{$key}"] = $value;
        }
        $press->members_count = count($members);
        $press->members = json_encode($members);
        $press->social_links = $request->get('social_links', []);
        $press->save();

        $user = User::find( Auth::user()->id);
        $mail['email'] = $user->email;
        $mail['nickname'] = $user->profile->nickname;
        $mail['title'] = $press->media_name;
        $mail['page'] = '/press/'. $press->id;
        SendApplicationEmailJob::dispatch($mail)
            ->delay(now()->addSeconds(2));
        $mail['email'] = 'khanifest+photo@gmail.com';
        $mail['nickname'] = 'Admin';
        SendForAdminNewAppEmailJob::dispatch($mail)
            ->delay(now()->addSeconds(2));

        return redirect('press')->with('success', "Вашу заявку успішно відправлено.");
    }
}