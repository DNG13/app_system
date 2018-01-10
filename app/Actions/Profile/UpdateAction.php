<?php

namespace App\Actions\Profile;

use App\Abstracts\Action;
use App\Models\Profile;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UpdateAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $data)
    {
        $avatar = Avatar::where('user_id', Auth::user()->id)->first();

        if($data['avatar']) {
            if(!$avatar) {
                $avatar = new Avatar();
                $avatar->user_id = Auth::user()->id;
            }
            $imageFile = $data['avatar'];
            $extension = $imageFile->extension();
            $imageName = Auth::user()->id . '_'.uniqid() .'.'. $extension;
            $imageFile->move(public_path('storage/uploads/avatars'), $imageName);
            $imagePath = 'storage/uploads/avatars/'.$imageName;

            // create Image from file
            $img = Image::make($imagePath);
            $img->resize(null, 100, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
            $avatar->link = $imagePath;
            $avatar->name = $imageName;
            $avatar->save();
        }

        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $profile->avatar_id = $avatar->id ?? null;
        $profile->surname = $data['surname'];
        $profile->first_name = $data['first_name'];
        $profile->nickname = $data['nickname'];
        $profile->birthday = $data['birthday'];
        $profile->phone = $data['phone'];
        $profile->city = $data['city'];
        $profile->social_links = json_encode($data['social_links']);
        $profile->info = $data['info'];
        $profile->save();
    }
}