<?php

namespace App\Http\Controllers;

use App\Models\App_type;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\App_fair;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class App_fairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Profile::where('user_id', Auth::user()->id)->pluck('nickname')->first();
        $app_types = App_type::where('app_type', 'fair')->get()->pluck('title', 'id');
        $fairs = App_fair::orderby('id', 'desc')
            ->where('user_id', Auth::user()->id)
            ->paginate(5);
        foreach($fairs as &$fair){
            if($fair->user_id == Auth::user()->id){
                $fair->user_id = $user;
            }
            foreach($app_types as $id =>$app_type) {
                if ($fair->type_id == $id) {
                    $fair->type_id = $app_type;
                }
            }
        }
        return view('pages.fair.index', compact('fairs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $app_types = App_type::where('app_type', 'fair')->get()->pluck('title', 'id');
        return view('pages.fair.create', compact('app_types'));
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
            'logo'=>'required|image|mimes:jpeg,jpg,png|max:4096',
            'type_id' => 'required',
            'group_nick'=>'required|string|max:100',
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:64',
            'members_count' => 'required|numeric',
            'social_link'=>'required',
            'group_link'=>'required',
            'square' => 'required|numeric',
            'payment_type'=>'required|string|max:64',
            'description' => 'required|string',
        ]);
        //store in database
        $fair = new App_fair();
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
        $fair->user_id = Auth::user()->id;
        $fair->status = 'В обработке';

        $equipment = [];
        foreach($request->input('equipment') as  $key => $value) {
            $equipment["{$key}"] = $value;
        }
        $fair->equipment = json_encode($equipment);
        $fair->save();

        return redirect('fair');
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
        $fair = App_fair::where('id', $id)->first();
        $fair->user_id = $user;
        $app_types = App_type::where('app_type', 'fair')->get()->pluck('title', 'id');
        foreach($app_types as $id =>$app_type) {
            if ($fair->type_id == $id) {
                $fair->type_id = $app_type;
            }
        }
        $equipment =  json_decode($fair->equipment);
        return view('pages.fair.show', compact('fair', 'equipment'));
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
        $fair = App_fair::where('id', $id)->first();
        $fair->user_id = $user;
        $app_types = App_type::where('app_type', 'fair')->get()->pluck('title', 'id');
        $equipment =  json_decode($fair->equipment);
        return view('pages.fair.edit', compact('app_types', 'fair', 'equipment'));
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
            'logo'=>'required|image|mimes:jpeg,jpg,png|max:4096',
            'type_id' => 'required',
            'group_nick'=>'required|string|max:100',
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:64',
            'members_count' => 'required|numeric',
            'social_link'=>'required',
            'group_link'=>'required',
            'square' => 'required|numeric',
            'payment_type'=>'required|string|max:64',
            'description' => 'required|string',
        ]);

        //store in database
        $fair = App_fair::where('id', $id)->first();
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
        $fair->user_id = Auth::user()->id;

        $equipment = [];
        foreach($request->input('equipment') as  $key => $value) {
            $equipment["{$key}"] = $value;
        }
        $fair->equipment = json_encode($equipment);
        $fair->save();
        return redirect('fair');
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
