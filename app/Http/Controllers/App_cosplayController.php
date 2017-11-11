<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\App_cosplay;
use Illuminate\Http\Request;

class App_cosplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_cosplays = App_cosplay::orderby('id', 'desc')
            ->where('user_id', Auth::user()->id)
            ->paginate(5);
        return view('pages.app_cosplay.index', compact('app_cosplays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.app_cosplay.create');
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
            'type_id' => 'required',
            'title' => 'required|string|max:255',
            'fandom' => 'required|string|max:255',
            'length' => 'required|numeric',
            'city' => 'required|string|max:100',
            'description' => 'required|string',
            'prev_part' => '',
            'comment' => '',


        ]);
        //store in database
        $app_cosplays = new App_cosplay();
        $app_cosplays->type_id = $request->get('type_id');
        $app_cosplays->title = $request->get('title');
        $app_cosplays->fandom = $request->get('fandom');
        $app_cosplays->length = $request->get('length');
        $app_cosplays->city = $request->get('city');
        $app_cosplays->description = $request->get('description');
        $app_cosplays->prev_part = $request->get('prev_part');
        $app_cosplays->comment = $request->get('comment');
        $app_cosplays->user_id = Auth::user()->id;

        $app_cosplays->status = 'В обработке';
        $app_cosplays->members = json_encode('');
        $app_cosplays->save();
        return redirect('app_cosplay');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $app_cosplay = App_cosplay::where('id', $id)->first();
        return view('pages.app_cosplay.show', compact('app_cosplay'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $app_cosplay = App_cosplay::where('id', $id)->first();
        return view('pages.app_cosplay.edit', compact('app_cosplay'));
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
        dd($id);
        //validate the data
        $this->validate($request,[
            'type_id' => 'required',
            'title' => 'required|string|max:255',
            'fandom' => 'required|string|max:255',
            'length' => 'required|numeric',
            'city' => 'required|string|max:100',
            'description' => 'required|string',
            'prev_part' => '',
            'comment' => '',


        ]);
        //store in database
        $app_cosplays = App_cosplay::where('id', $id);
        $app_cosplays->type_id = $request->get('type_id');
        $app_cosplays->title = $request->get('title');
        $app_cosplays->fandom = $request->get('fandom');
        $app_cosplays->length = $request->get('length');
        $app_cosplays->city = $request->get('city');
        $app_cosplays->description = $request->get('description');
        $app_cosplays->prev_part = $request->get('prev_part');
        $app_cosplays->comment = $request->get('comment');
        $app_cosplays->user_id = Auth::user()->id;

        $app_cosplays->status = 'В обработке';
        $app_cosplays->members = json_encode('');
        $app_cosplays->save();
        return redirect('app_cosplay');
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
