<?php

namespace App\Http\Controllers;

use App\Models\AppType;
use Illuminate\Support\Facades\Auth;
use App\Models\AppFair;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Comment;

class AppFairController extends Controller
{
    private $sortFields = [
        'id',
        'user_id',
        'type_id',
        'created_at',
        'updated_at',
        'members_count',
        'phone',
        'contact_name',
        'group_nick',
        'square',
        'status'
    ];

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $types = AppType::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        $data = $request->all();
        $keyword = $request->get('search');

        $query = AppFair::select('*')
            ->where('user_id', Auth::user()->id)
            ->orderby($request->order_by ?? 'id', $request->order ?? 'asc');

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('contact_name', 'LIKE', "%$keyword%")
                    ->orWhere('group_nick', 'LIKE', "%$keyword%");
            });
        }

        if(!empty($request->get('type_id'))){
            $query->where('type_id', $request->get('type_id'));
        }

        if(!empty($request->get('user_id'))){
            $query->where('user_id', $request->get('user_id'));
        }

        if(!empty($request->get('status'))){
            $query->where('status', $request->get('status'));
        }

        if(!empty($request->get('id'))){
            $query->where('id', $request->get('id'));
        }

        $applications = $query->paginate(5);

        return view('pages.fair.index', [
            'applications' => $applications,
            'sort' => $this->prepareSort($request, $this->sortFields),
            'types' => $types,
                'data' =>$data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = AppType::where('app_type', 'fair')->get()->pluck('title', 'id');
        return view('pages.fair.create', compact('types'));
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
        $fair = new AppFair();
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
        $fair = AppFair::where('id', $id)->first();
        $equipment =  json_decode($fair->equipment);
        $comments = Comment::orderBy('created_at','desc')
            ->where('app_kind', 'fair')
            ->where('app_id', $fair->id)->get();
        return view('pages.fair.show', compact('fair', 'equipment', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fair = AppFair::where('id', $id)->first();
        $types = AppType::where('app_type', 'fair')->get()->pluck('title', 'id');
        $equipment =  json_decode($fair->equipment);
        return view('pages.fair.edit', compact('types', 'fair', 'equipment'));
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
            'logo'=>'image|mimes:jpeg,jpg,png|max:4096',
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
        $fair = AppFair::where('id', $id)->first();
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
