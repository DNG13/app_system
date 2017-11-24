<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Profile;
use App\Models\Avatar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Intervention\Image\Facades\Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'avatar'=>'required|image|mimes:jpeg,jpg,png|max:4096',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = new User();
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->fb = null;
        $user->save();

        $user_id = $user->id;

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

        $avatar_id = $avatar->id;

        $profile = new Profile();
        $profile->user_id = $user_id;
        $profile->avatar_id= $avatar_id;
        $profile->surname = $data['surname'];
        $profile->first_name = $data['first_name'];
        $profile->middle_name = $data['middle_name'];
        if($data['nickname']==null){
            $data['nickname'] = $data['surname'] .' '. $data['first_name'];
        }
        $profile->nickname = $data['nickname'];
        $profile->birthday = $data['birthday'];
        $profile->phone = $data['phone'];
        $profile->city = $data['city'];
        $profile->social_links = json_encode($data['social_links']);
        $profile->info = $data['info'];
        $profile->save();

        return $user;
    }
}
