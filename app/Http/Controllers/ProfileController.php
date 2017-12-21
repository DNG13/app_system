<?php

namespace App\Http\Controllers;

use App\Actions\Profile\UpdateAction;
use App\Models\Avatar;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $avatar = Avatar::where('user_id', Auth::user()->id)->pluck('link')->first();
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $social_links =  json_decode($profile->social_links);

        return view('pages.profile.index', compact('profile', 'social_links', 'avatar'));
    }

    public function edit() {
        $avatar = Avatar::where('user_id', Auth::user()->id)->pluck('link')->first();
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $social_links =  json_decode($profile->social_links);

        return view('pages.profile.edit', compact('profile', 'social_links', 'avatar'));
    }

    /**
     * @param Request $data
     * @param UpdateAction $action
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $data, UpdateAction $action){

        $this->validate(request(),[
            'avatar'=>'nullable|image|mimes:jpeg,jpg,png|max:4096',
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
        $action->run($data);

        return redirect('profile');
    }

    public function show($data)
    {
        $avatar = Avatar::where('user_id', $data)->pluck('link')->first();
        $profile = Profile::where('user_id', $data)->first();
        $social_links =  json_decode($profile->social_links);

        return view('pages.profile.index', compact('profile', 'social_links', 'avatar'));
    }
}
