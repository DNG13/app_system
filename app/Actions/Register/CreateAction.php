<?php

namespace App\Actions\Register;

use App\Abstracts\Action;
use App\Jobs\SendActivationEmailJob;
use App\Models\Profile;
use App\Models\Avatar;
use App\User;
use Intervention\Image\Facades\Image;

class CreateAction extends Action
{

    public function __construct()
    {

    }

    public function run(array $data, $user_id)
    {
        if (!empty($data['avatar'])) {
            $avatar = new Avatar();
            $avatar->user_id = $user_id;
            if($data['avatar']) {
                $imageFile = $data['avatar'];
                $extension = $imageFile->extension();
                $imageName = $user_id . '_'.uniqid() .'.'. $extension;
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
        }

        $profile = new Profile();
        $profile->user_id = $user_id;
        $profile->avatar_id = $avatar->id ?? null;
        $profile->surname = $data['surname'];
        $profile->first_name = $data['first_name'];

        if(is_null($data['nickname'])) {
            $data['nickname'] = $data['surname'] .' '. $data['first_name'];
        }

        $profile->nickname = $data['nickname'];
        $profile->birthday = $data['birthday'];
        $profile->phone = $data['phone'];
        $profile->city = $data['city'];
        $profile->social_links = json_encode($data['social_links']);
        $profile->info = $data['info'];
        $profile->save();

        $confirmation = ['code' => str_random(30), 'created' => gmdate('Y-m-d H:i:s'), 'type' => 'confirm'];
        $myUser = User::find($user_id);
        $myUser->confirmation_code = $confirmation;
        $myUser->save();

        $mail['confirmation_code'] = $confirmation['code'];
        $mail['id'] = $user_id;
        $mail['nickname'] = $data['nickname'];
        $mail['email'] = $myUser->email;
        SendActivationEmailJob::dispatch($mail)
            ->delay(now()->addSeconds(2));
    }
}