<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $social_links =  json_decode($profile->social_links);
        return view('pages.profile', compact('profile', 'social_links'));
    }

    public function edit(){
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $social_links =  json_decode($profile->social_links);
        return view('pages.edit_profile', compact('profile', 'social_links'));
    }

    public function update(Request $data){

        $this->validate(request(),[
            'surname' => 'required|string|max:64',
            'first_name' => 'required|string|max:64',
            'middle_name' => 'required|string|max:64',
            'nickname' => 'max:64',
            'birthday' => 'required|date',
            'phone' => 'required|string|max:64',
            'city' => 'required|string|max:100',
            'social_links' => '',
            'info' => '',
        ]);
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $profile->avatar_id = '1';
        $profile->surname = $data['surname'];
        $profile->first_name = $data['first_name'];
        $profile->middle_name = $data['middle_name'];
        $profile->nickname = $data['nickname'];
        $profile->birthday = $data['birthday'];
        $profile->phone = $data['phone'];
        $profile->city = $data['city'];
        $profile->social_links = json_encode($data['social_links']);
        $profile->info = $data['info'];
        $profile->save();

        return redirect('profile');
    }
}
