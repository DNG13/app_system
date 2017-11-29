<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App_type;
use Illuminate\Support\Facades\Auth;
use App\Models\App_press;

class AppPressController extends Controller
{
    private $sortFields = [
        'id',
        'user_id',
        'type_id',
        'status',
        'created_at',
        'updated_at',
        'members_count',
        'phone',
        'city',
        'contact_name',
        'media_name',
    ];

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        $query = App_press::select('*')
            ->where('user_id', Auth::user()->id)
            ->orderby($request->order_by ?? 'id', $request->order ?? 'asc');

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('contact_name', 'LIKE', "%$keyword%")
                    ->orWhere('media_name', 'LIKE', "%$keyword%")
                    ->orWhere('city', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%");
            });
        }

        $applications = $query->paginate(5);

        return view('pages.press.index', ['applications' => $applications, 'sort' => $this->prepareSort($request, $this->sortFields)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = App_type::where('app_type', 'press')->get()->pluck('title', 'id');
        return view('pages.press.create', compact('types'));
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
        $press = App_press::where('id', $id)->first();
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
        $press = App_press::where('id', $id)->first();
        $types = App_type::where('app_type', 'press')->get()->pluck('title', 'id');
        $social_links =  json_decode($press->social_links);
        return view('pages.press.edit', compact('types', 'press', 'social_links'));
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
