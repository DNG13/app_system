<?php
namespace App\Actions\AppVolunteer;

use App\Abstracts\Action;
use App\Jobs\SendEditEmailJob;
use App\Jobs\SendStatusEmailJob;
use App\Models\AppVolunteer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request, $id)
    {
        $volunteer = AppVolunteer::where('id', $id)->first();

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

        $volunteer->surname= $request->get('surname');
        $volunteer->first_name = $request->get('first_name');
        $volunteer->middle_name = $request->get('middle_name');
        $volunteer->nickname = $request->get('nickname');
        $volunteer->birthday = $request->get('birthday');
        $volunteer->phone = $request->get('phone');
        $volunteer->city = $request->get('city');
        $volunteer->social_links = json_encode($request['social_links']);
        $volunteer->skills= $request->get('skills');
        $volunteer->difficulties = $request->get('difficulties');
        $volunteer->experience = $request->get('experience');

        if($request->get('status') && Auth::user()->isAdmin()) {
            if($volunteer->status != $request->get('status')) {
                $user = User::where('id', $volunteer->user_id)->first();
                $mail['email'] = $user->email;
                $mail['nickname'] = $user->profile->nickname;
                $mail['title'] = $volunteer->nickname;
                $mail['page'] = '/volunteer/' . $volunteer->id;
                $mail['status'] = $request->get('status');
                SendStatusEmailJob::dispatch($mail)
                    ->delay(now()->addSeconds(2));
            }
            $volunteer->status = $request->get('status');
        }
        $volunteer->save();

        if (!Auth::user()->isAdmin()) {
            $mail['nickname'] = 'Admin';
            $mail['email'] = 'khanifest+volunteers@gmail.com';
            $mail['title'] = $volunteer->nickname;
            $mail['page'] = '/volunteer/'. $volunteer->id;
            $mail['from'] = Auth::user()->email;
            SendEditEmailJob::dispatch($mail)
                ->delay(now()->addSeconds(2));
        }

        return redirect('volunteer')->with('success', "Ваша заявка успешно изменена.");
    }
}