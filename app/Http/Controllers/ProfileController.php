<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    public function index()
    {
        $avatar = Avatar::where('user_id', Auth::user()->id)->pluck('link')->first();
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $social_links =  json_decode($profile->social_links);
        return view('pages.profile.index', compact('profile', 'social_links', 'avatar'));
    }

    public function edit(){
        $avatar = Avatar::where('user_id', Auth::user()->id)->pluck('link')->first();
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $social_links =  json_decode($profile->social_links);
        return view('pages.profile.edit', compact('profile', 'social_links', 'avatar'));
    }

    public function update(Request $data){

        $this->validate(request(),[
            'avatar'=>'nullable|image|mimes:jpeg,jpg,png|max:4096',
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
        $avatar = Avatar::where('user_id', Auth::user()->id)->first();
        $avatar->user_id =  Auth::user()->id;
        if($data['avatar']) {
            $imageFile = $data['avatar'];
            $extension = $imageFile->extension();
            $imageName = Auth::user()->id . '_'.uniqid() .'.'. $extension;
            $imageFile->move(public_path('uploads/avatars'), $imageName);
            $imagePath = 'uploads/avatars/'.$imageName;

            // create Image from file
            $img = Image::make($imagePath);
            $img->resize(null, 100, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
            $avatar->link = $imagePath;
            $avatar->name = $imageName;
        }
        $avatar->save();

//        $avatar_id = $avatar->id;
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
