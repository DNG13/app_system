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
            } else {
                unlink(storage_path($avatar->link));
            }
            $imageFile = $data['avatar'];
            $extension = $imageFile->extension();
            $imageName = Auth::user()->id . '_'.uniqid() .'.'. $extension;
            $imageFile->move(storage_path('/uploads/avatars'), $imageName);
            $avatar->link = '/uploads/avatars/'.$imageName;
            $imagePath = storage_path($avatar->link);
            // create Image from file
            $img = Image::make($imagePath);
            [$width, $height] = getimagesize($imagePath);
            if($width <= $height) {
                $img->resize(null, 100, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $img->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $img->save();
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