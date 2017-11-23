<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\App_volunteer;


class App_volunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $volunteers = App_volunteer::orderby('id', 'desc')
            ->where('user_id', Auth::user()->id)
            ->paginate(5);
        return view('pages.volunteer.index', compact('volunteers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.volunteer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request,[
            'skills' => 'required|string',
            'difficulties' => 'required|string',
            'experience' => 'required|string',
        ]);
        //store in database
        $volunteer = new App_volunteer();
        $volunteer->skills= $request->get('skills');
        $volunteer->difficulties = $request->get('difficulties');
        $volunteer->experience = $request->get('experience');
        $volunteer->user_id = Auth::user()->id;
        $volunteer->status = 'В обработке';
        $volunteer->save();
        return redirect('volunteer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Profile::where('user_id', Auth::user()->id)->pluck('nickname')->first();
        $volunteer= App_volunteer::where('id', $id)->first();
        $volunteer->user_id = $user;
        return view('pages.volunteer.show', compact('volunteer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Profile::where('user_id', Auth::user()->id)->pluck('nickname')->first();
        $volunteer = App_volunteer::where('id', $id)->first();
        $volunteer->user_id = $user;

        return view('pages.volunteer.edit', compact('volunteer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate the data
        $this->validate($request,[
            'skills' => 'required|string',
            'difficulties' => 'required|string',
            'experience' => 'required|string',
        ]);
        //store in database
        $volunteer = App_volunteer::where('id', $id)->first();
        $volunteer->skills= $request->get('skills');
        $volunteer->difficulties = $request->get('difficulties');
        $volunteer->experience = $request->get('experience');
        $volunteer->user_id = Auth::user()->id;
        $volunteer->status = 'В обработке';
        $volunteer->save();
        return redirect('volunteer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
