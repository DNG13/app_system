<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Register\CreateAction;
use App\Actions\Register\HandleProviderCallbackAction;
use App\Actions\Register\ProfileFacebookAction;
use App\Actions\Register\UserReactivationSendAction;
use App\Http\Requests\Register\ProfileFacebookRequest;
use App\User;
use App\Models\Profile;
use App\Models\Avatar;
use App\Abstracts\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
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
            'avatar'=>'nullable|image|mimes:jpeg,jpg,png|max:4096',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'surname' => 'required|string|max:64',
            'first_name' => 'required|string|max:64',
            'nickname' => 'max:64',
            'birthday' => 'required|date',
            'phone' => 'required|string|max:64',
            'city' => 'required|string|max:100',
            'social_links' => ''
        ]);
    }

    /**
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User();
        $user->email = strtolower($data['email']);
        $user->password = bcrypt($data['password']);
        $user->fb = $data['fb']?? null;
        $user->save();
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
     * @param HandleProviderCallbackAction $action
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function handleProviderCallback(HandleProviderCallbackAction $action)
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
            if(is_null($socialUser->getEmail())) {
                return redirect()->to('login')->with('warning',"Сохратить настройки аккаунта без email невозможно.");
            }
            $user_id = $action->run($socialUser);
            $avatar = Avatar::where('user_id', $user_id )->pluck('link')->first();
            $profile = Profile::where('user_id', $user_id )->first();
            $social_links =  json_decode($profile->social_links);
            return view('auth.profile', compact('profile', 'social_links', 'avatar'));
        }
        auth()->login($user);
        return redirect('/home');
    }

    /**
     * @param ProfileFacebookRequest $data
     * @param ProfileFacebookAction $action
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function profileFacebook(ProfileFacebookRequest $data, ProfileFacebookAction $action)
    {
        $action->run($data);
        return redirect('profile');
    }

    /**
     * @param Request $request
     * @param CreateAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request, CreateAction $action)
    {
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->passes()){
            $user = $this->create($input)->toArray();
            $action->run( $input, $user['id']);

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
    public function userActivation($id, $code)
    {
        $user = User::find($id);
        if(!is_null($user)){
            if (!is_null($user->confirmed_at)){
                if(!Auth::user()){
                    auth()->login($user);
                }
                return redirect()->to('home')->with('success', "Профиль уже подтвержден.");
            }

            if ($user->confirmation_code['code'] == $code
                && $user->confirmation_code['type'] == 'confirm'
                && strtotime($user->confirmation_code['created']) > (time() - (60*60*24))
            ) {
                $user->confirmed_at = Carbon::now();
                $user->confirmation_code = [];
                $user->save();
                auth()->login($user);

                return redirect()->to('home')->with('success', "Поздравляем, ваш аккаунт подтвержден.");
            }
        }
        return redirect()->to('auth\reactivate')->with('warning', "Ваша ссылка не валидна.");
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
     * @param UserReactivationSendAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userReactivationSend(Request $request, UserReactivationSendAction $action)
    {
        if (empty($request->get('email'))) {
            return redirect()->to('auth\reactivate')->with('warning',"Email не найден");
        }

        //for lowercase
        $user = User::where('email', strtolower($request->email))->first();

        if (!$user) {
            return redirect()->to('auth\reactivate')->with('warning',"Email не найден");
        }

        if (!is_null($user->confirmed_at)){
            if(!Auth::user()){
                auth()->login($user);
            }
            return redirect()->to('home')->with('success',"Профиль уже подтвержден.");
        }
        $action->run($user);
        return redirect()->to('login')->with('success', "Вам повторно отправлен код активации, 
            по которому Вы можете подтвердить свою регистрацию. 
            Пожалуйста проверьте почту.");
    }
}