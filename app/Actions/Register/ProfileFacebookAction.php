<?php

namespace App\Actions\Register;

use App\Abstracts\Action;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use Mail;

class ProfileFacebookAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $data)
    {
        if(is_null($data['birthday']) || is_null($data['phone']) || is_null($data['city'])) {
            User:find($data->id)->delete();
        }
        $profile = Profile::where('user_id', $data->id)->first();

        if(is_null($data['nickname'])) {
            $data['nickname'] = $data['surname'] .' '. $data['first_name'];
        }

        $profile->birthday = $data['birthday'];
        $profile->phone = $data['phone'];
        $profile->city = $data['city'];
        $profile->social_links = json_encode($data['social_links']);
        $profile->info = $data['info'];
        $profile->save();
        $user = User::where('id', $data->id)->first();
        auth()->login($user);
    }
}