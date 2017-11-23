<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App_type;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\App_press;

class App_pressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Profile::where('user_id', Auth::user()->id)->pluck('nickname')->first();
        $app_types = App_type::where('app_type', 'press')->get()->pluck('title', 'id');
        $press = App_press::orderby('id', 'desc')
            ->where('user_id', Auth::user()->id)
            ->paginate(5);
        foreach($press  as &$item){
            if($item->user_id == Auth::user()->id){
                $item->user_id = $user;
            }
            foreach($app_types as $id =>$app_type) {
                if ($item->type_id == $id) {
                    $item->type_id = $app_type;
                }
            }
        }
        return view('pages.press.index', compact('press'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $app_types = App_type::where('app_type', 'press')->get()->pluck('title', 'id');
        return view('pages.press.create', compact('app_types'));
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
            'contact_name' => 'required|string|max:255',
            'media_name' => 'required|string|max:100',
            'phone' => 'required|string|max:64',
            'members_count' => 'required|numeric',
            'portfolio_link'=>'required',
            'equipment' => 'required|string',
            'city' => 'required|string|max:100',
            'camera' =>'required|string|max:100',
            'social_links' => '',
        ]);
        //store in database
        $press = new App_press();
        $press->type_id = $request->get('type_id');
        $press->media_name = $request->get('media_name');
        $press->contact_name = $request->get('contact_name');
        $press->phone = $request->get('phone');
        $press->members_count = $request->get('members_count');
        $press->equipment = $request->get('equipment');
        $press->portfolio_link = $request->get('portfolio_link');
        $press->city = $request->get('city');
        $press->camera = $request->get('camera');
        $press->user_id = Auth::user()->id;
        $press->status = 'В обработке';
        $press->social_links = json_encode($request['social_links']);
        $press->save();
        return redirect('press');
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
        $press = App_press::where('id', $id)->first();
        $press->user_id = $user;
        $app_types = App_type::where('app_type', 'press')->get()->pluck('title', 'id');
        foreach($app_types as $id =>$app_type) {
            if ($press->type_id == $id) {
                $press->type_id = $app_type;
            }
        }
        $social_links =  json_decode($press->social_links);
        return view('pages.press.show', compact('press', 'social_links'));
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
        $press = App_press::where('id', $id)->first();
        $press->user_id = $user;
        $app_types = App_type::where('app_type', 'press')->get()->pluck('title', 'id');
        $social_links =  json_decode($press->social_links);
        return view('pages.press.edit', compact('app_types', 'press', 'social_links'));
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
            'type_id' => 'required',
            'contact_name' => 'required|string|max:255',
            'media_name' => 'required|string|max:100',
            'phone' => 'required|string|max:64',
            'members_count' => 'required|numeric',
            'portfolio_link'=>'required',
            'equipment' => 'required|string',
            'city' => 'required|string|max:100',
            'camera' =>'required|string|max:100',
            'social_links' => '',
        ]);
        //store in database
        $press  = App_press::where('id', $id)->first();
        $press->type_id = $request->get('type_id');
        $press->media_name = $request->get('media_name');
        $press->contact_name = $request->get('contact_name');
        $press->phone = $request->get('phone');
        $press->members_count = $request->get('members_count');
        $press->equipment = $request->get('equipment');
        $press->portfolio_link = $request->get('portfolio_link');
        $press->city = $request->get('city');
        $press->camera = $request->get('camera');
        $press->user_id = Auth::user()->id;
        $press->status = 'В обработке';
        $press->social_links = json_encode($request['social_links']);
        $press->save();
        return redirect('press');
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
