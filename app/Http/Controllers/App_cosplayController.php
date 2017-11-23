<?php

namespace App\Http\Controllers;

use App\Models\App_type;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\App_cosplay;
use Illuminate\Http\Request;
use Validator;

class App_cosplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Profile::where('user_id', Auth::user()->id)->pluck('nickname')->first();
        $app_types = App_type::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        $app_cosplays = App_cosplay::orderby('id', 'desc')
            ->where('user_id', Auth::user()->id)
            ->paginate(5);
        foreach($app_cosplays as &$app_cosplay){
            if($app_cosplay->user_id == Auth::user()->id){
                $app_cosplay->user_id = $user;
            }
            foreach($app_types as $id =>$app_type) {
                if ($app_cosplay->type_id == $id) {
                    $app_cosplay->type_id = $app_type;
                }
            }
        }
        return view('pages.cosplay.index', compact('app_cosplays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $app_types = App_type::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        return view('pages.cosplay.create', compact('app_types'));
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

        $members = [];
        foreach($request->input('members') as  $key => $value) {
            $members["member{$key}"] = $value;
        }
        $app_cosplays->members_count = count($members);
        $app_cosplays->members = json_encode($members);
        $app_cosplays->save();
        return redirect('cosplay');
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
        $app_cosplay = App_cosplay::where('id', $id)->first();
        $app_cosplay->user_id = $user;
        $app_types = App_type::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        foreach($app_types as $id =>$app_type) {
            if ($app_cosplay->type_id == $id) {
                $app_cosplay->type_id = $app_type;
            }
        }
        $members =  json_decode($app_cosplay->members);
        $count = 0;
        return view('pages.cosplay.show', compact('app_cosplay', 'members', 'count'));
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
        $app_cosplay = App_cosplay::where('id', $id)->first();
        $app_cosplay->user_id = $user;
        $app_types = App_type::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        $members =  json_decode($app_cosplay->members);
        $count = 0;
        return view('pages.cosplay.edit', compact('app_types', 'app_cosplay', 'members', 'count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $app_cosplays = App_cosplay::where('id', $id)->first();
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

        $members = [];
        foreach($request->input('members') as  $key => $value) {
            $members["member{$key}"] = $value;
        }
        $app_cosplays->members_count = count($members);
        $app_cosplays->members = json_encode($members);
        $app_cosplays->save();
        return redirect('cosplay');
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
