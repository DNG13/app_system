<?php

namespace App\Actions\Register;

use App\Abstracts\Action;
use App\Models\Avatar;
use App\Models\Profile;
use App\User;
use Intervention\Image\Facades\Image;
use File;

class HandleProviderCallbackAction extends Action
{

    public function __construct()
    {

    }

    public function run($socialUser)
    {
        $user = new User();
        $user->email = $socialUser->getEmail();
        $user->fb = $socialUser->getId();
        $user->password = bcrypt($user->fb);
        $user->save();

        $user_id = $user->id;

        if($socialUser->getAvatar()) {
            $avatar = new Avatar();
            $avatar->user_id = $user_id;
            $fileContents = file_get_contents($socialUser->getAvatar());
            $imageName = $user_id . '_' . uniqid()  . ".jpg";
            File::put(storage_path() . '/uploads/avatars/' . $imageName, $fileContents);
            $avatar->link = 'uploads/avatars/' . $imageName;
            $avatar->name = $imageName;
            $img = Image::make(storage_path($avatar->link));
            $img->resize(null, 100, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
            $avatar->save();
        }

        $profile = new Profile();
        $profile->user_id = $user_id;
        $profile->avatar_id = $avatar->id ?? null;
        $profile->nickname = $socialUser->getName()?? null;
        if(is_null($profile->nickname)) {
            $profile->surname =  null;
            $profile->first_name =  null;
        }else {
            $fbName = explode(" ", $socialUser->getName());
            $profile->surname = $fbName[1]?? null;
            $profile->first_name = $fbName[0]?? null;
        }
        $social_links = ['tg' => null, 'fb' => null, 'sk'=>null, 'in'=>null];
        $profile->social_links = json_encode($social_links);
        $profile->save();

        return $user_id;
    }
}