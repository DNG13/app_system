<?php

namespace App\Http\Controllers;

use App\Actions\Profile\UpdateAction;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Avatar;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Abstracts\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $avatar = Avatar::where('user_id', Auth::user()->id)->pluck('link')->first();
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $social_links =  json_decode($profile->social_links);

        return view('pages.profile.index', compact('profile', 'social_links', 'avatar'));
    }

    public function edit()
    {
        $avatar = Avatar::where('user_id', Auth::user()->id)->pluck('link')->first();
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $social_links =  json_decode($profile->social_links);

        return view('pages.profile.edit', compact('profile', 'social_links', 'avatar'));
    }

    /**
     * @param UpdateRequest $data
     * @param UpdateAction $action
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateRequest $data, UpdateAction $action)
    {
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
