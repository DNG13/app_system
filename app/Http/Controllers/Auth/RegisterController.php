<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\Models\Profile;
use App\Models\Avatar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Mail;
use File;
use DB;
use Carbon\Carbon;

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
     * RegisterController constructor.
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
            'avatar'=>'image|mimes:jpeg,jpg,png|max:4096',
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
            'fb'=>'',
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
        $user->fb = $data['fb']?? null;
        $user->save();

        $user_id = $user->id;

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

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $socialUser = Socialite::driver('facebook')->user();
        }catch (\Exception $exception) {
            return redirect('/');
        };

        $user = User::where('fb', $socialUser->getId())->first();

        if (!$user) {
            $user = User::where('email', $socialUser->getEmail())->first();
        }

        if(!$user) {
            $user = new User();
            $user->email = $socialUser->getEmail();
            $user->fb = $socialUser->getId();
            $user->password = bcrypt($user->fb);
            $user->save();

            $user_id = $user->id;

            $avatar = new Avatar();
            $avatar->user_id = $user_id;
            $socialUser->getAvatar();
            $fileContents = file_get_contents($socialUser->getAvatar());
            $imageName =  $user_id . '_'.uniqid() .'.' . ".jpg";
            File::put(public_path() . '/uploads/avatars/' .  $imageName, $fileContents);
            $avatar->link = 'uploads/avatars/'.$imageName;
            $avatar->name = $imageName;
            $avatar->save();

            $avatar_id = $avatar->id;

            $profile = new Profile();
            $profile->user_id = $user_id;
            $profile->avatar_id = $avatar_id;
            $profile->nickname = $socialUser->getName();
            $fbName = explode(" ", $socialUser->getName());
            $profile->surname =  $fbName [1];
            $profile->first_name = $fbName [0];
            $social_links = ['vk' => null, 'tg' => null, 'fb' => null, 'sk'=>null];
            $profile->social_links = json_encode($social_links);
            $profile->save();

            auth()->login($user);
            $avatar = Avatar::where('user_id', Auth::user()->id)->pluck('link')->first();
            $profile = Profile::where('user_id', Auth::user()->id)->first();
            $social_links =  json_decode($profile->social_links);
            return view('pages.profile.edit', compact('profile', 'social_links', 'avatar'));
        }
        auth()->login($user);
        return redirect('/home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function register(Request $request) {
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->passes()){
            $user = $this->create($input)->toArray();
            $confirmation = ['code' => str_random(30), 'created' => gmdate('Y-m-d H:i:s'), 'type' => 'confirm'];

            $myUser = User::find($user['id']);
            $myUser->confirmation_code = $confirmation;
            $myUser->save();

            Mail::send('mails.activation',  ['confirmation_code' => $confirmation, 'id' => $user['id']] , function($message) use ( $user ){
                $message->to( $user ['email']);
                $message->subject('Код активации сайта Khanifest');
            });
            return redirect()->to('login')->with('success', "Пользователь успешно создан. 
            Вам отправлен код активации, 
            по которому Вы можете подтвердить свою регистрацию. 
            Пожалуйста проверьте почту.");
        }
        return back()->with('errors',$validator->errors());
    }

    /**
     * @param $id
     * @param $code
     * @return \Illuminate\Http\RedirectResponse
     */

    public function userActivation($id, $code) {

        $user = User::find($id);

        if(!is_null($user)){

            if (!is_null($user->confirmed_at)){
                return redirect()->to('home')->with('success',"Профиль уже подтвержден.");
            }

            if ($user->confirmation_code['code'] == $code
                && $user->confirmation_code['type'] == 'confirm'
                && strtotime($user->confirmation_code['created']) > (time() - (60*60*24))
            ) {
                $user->confirmed_at = Carbon::now();
                $user->confirmation_code = [];
                $user->save();
                auth()->login($user);
                return redirect()->to('home')->with('success',"Поздравляем, ваш аккаунт подтвержден.");
            }
        }

        return redirect()->to('auth\reactivate')->with('warning',"Ваша ссылка не валидна.");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userReactivation()
    {
        return view('auth.reactivate');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userReactivationSend(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->to('auth\reactivate')->with('warning',"Email не найден");
        }

        if (!is_null($user->confirmed_at)){
            return redirect()->to('home')->with('success',"Профиль уже подтвержден.");
        }

        $confirmation = ['code' => str_random(30), 'created' => gmdate('Y-m-d H:i:s'), 'type' => 'confirm'];
        $user->confirmation_code = $confirmation;
        $user->save();

        Mail::send('mails.activation',  ['confirmation_code' => $confirmation, 'id' => $user['id']] , function($message) use ( $user ){
            $message->to( $user ['email']);
            $message->subject('Код активации сайта Khanifest');
        });
        return redirect()->to('login')->with('success', "Вам повторно отправлен код активации, 
            по которому Вы можете подтвердить свою регистрацию. 
            Пожалуйста проверьте почту.");
    }
}
