<?php

namespace App\Actions\AppVolunteer;

use App\User;
use App\Abstracts\Action;
use App\Mail\Application;
use App\Mail\ForAdminNewApp;
use App\Models\AppVolunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;

class StoreAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request)
    {
        $volunteer = new AppVolunteer();
        $volunteer->surname= $request->get('surname');
        $volunteer->first_name = $request->get('first_name');
        $volunteer->middle_name = $request->get('middle_name');

        if(is_null($request->get('nickname'))) {
            $volunteer->nickname = $request->get('surname') .' '. $request->get('first_name');
        }else {
            $volunteer->nickname = $request->get('nickname');
        }

        if($request['photo']) {
            $imageFile = $request['photo'];
            $extension = $imageFile->extension();
            $imageName = Auth::user()->id . '_'.uniqid() .'.'. $extension;
            $imageFile->move(public_path('uploads/volunteers'), $imageName);
            $imagePath = 'uploads/volunteers/'.$imageName;

            // create Image from file
            $img = Image::make($imagePath);
            $img->resize(null, 100, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
            $volunteer->photo= $imagePath;
        }

        $volunteer->birthday = $request->get('birthday');
        $volunteer->phone = $request->get('phone');
        $volunteer->city = $request->get('city');
        $volunteer->social_links = json_encode($request['social_links']);
        $volunteer->skills = $request->get('skills');
        $volunteer->difficulties = $request->get('difficulties');
        $volunteer->experience = $request->get('experience');
        $volunteer->user_id = Auth::user()->id;
        $volunteer->status = 'В обработке';
        $volunteer->save();

        $user = User::find( Auth::user()->id);
        $mail['email'] = $user->email;
        $mail['nickname'] = $user->profile->nickname;
        $mail['title'] = $volunteer->nickname;
        $mail['page'] = "/volunteer/ $volunteer->id";
        Mail::to($mail['email'])->send(new Application($mail));
        $mail['email'] = 'khanifest+volunteers@gmail.com';
        $mail['nickname'] = 'Admin';
        Mail::to($mail['email'])->send(new ForAdminNewApp($mail));

        return redirect('volunteer')->with('success', "Ваша заявка успешно отправлена.");
    }
}