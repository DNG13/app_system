<?php

namespace App\Actions\AppFair;

use App\Abstracts\Action;
use App\Models\AppFair;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UpdateAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request, $id)
    {
        //store in database
        $fair = AppFair::where('id', $id)->first();
        $fair->type_id = $request->get('type_id');
        $fair->group_nick = $request->get('group_nick');
        if($request['logo']) {
            $imageFile = $request['logo'];
            $extension = $imageFile->extension();
            $imageName = Auth::user()->id . '_'.uniqid() .'.'. $extension;
            $imageFile->move(public_path('uploads/logos'), $imageName);
            $imagePath = 'uploads/logos/'.$imageName;

            // create Image from file
            $img = Image::make($imagePath);
            $img->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
            $fair->logo = $imagePath;
        }
        $fair->contact_name = $request->get('contact_name');
        $fair->phone = $request->get('phone');
        $fair->members_count = $request->get('members_count');
        $fair->social_link = $request->get('social_link');
        $fair->group_link = $request->get('group_link');
        $fair->square = $request->get('square');
        $fair->payment_type= $request->get('payment_type');
        $fair->description= $request->get('description');

        if($fair->status != $request->get('status')) {
            $user =  User::where('id', $fair->user_id)->first();
            $mail['email'] = $user->email;
            $mail['nickname'] = $user->profile->nickname;
            $mail['title'] = $fair->group_nick;
            $mail['page'] = '/fair/'. $fair->id;
            $mail['status'] = $request->get('status');
            Mail::send('mails.status',  $mail , function($message) use ( $mail ){
                $message->to( $mail['email']);
                $message->subject('Заявка ' .$mail['title'] . ' изменена');
            });
        }
        if($request->get('status')) {
            if (Auth::user()->isAdmin()) {
                $fair->status = $request->get('status');
            }
        }
        $equipment = [];
        foreach($request->input('equipment') as  $key => $value) {
            $equipment["{$key}"] = $value;
        }
        $fair->equipment = json_encode($equipment);
        $fair->save();
        if (!Auth::user()->isAdmin()) {
            $mail['nickname'] = 'Admin';
            $mail['email'] = 'khanifest.mail@gmail.com';
            $mail['title'] = $fair->title;
            $mail['page'] = '/fair/'. $fair->id;
            Mail::send('mails.edit', $mail, function ($message) use ($mail) {
                $message->to($mail['email']);
                $message->subject('Заявка ' .$mail['title'] . ' изменена');
            });
        }
        return redirect('fair')->with('success', "Ваша заявка успешно изменена.");
    }
}
