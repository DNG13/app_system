<?php

namespace App\Http\Controllers;

use App\Actions\AppPress\StoreAction;
use App\Actions\AppPress\ListAction;
use App\Actions\AppPress\UpdateAction;
use App\Models\AppFile;
use App\Models\AppType;
use App\Models\AppPress;
use App\Models\Comment;
use Illuminate\Http\Request;
use Mail;

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
     * @param ListAction $action
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, ListAction $action)
    {
        $types = AppType::where('app_type', 'press')->get()->pluck('title', 'id');
        $data = $request->all();

        return view('pages.press.index', [
            'applications' => $action->run($request),
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
        $types = AppType::where('app_type', 'press')->get()->pluck('title', 'id');
        return view('pages.press.create', compact('types'));
    }

    /**
     * @param Request $request
     * @param StoreAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, StoreAction $action)
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

        return $action->run($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $press = AppPress::where('id', $id)->first();
        $files = AppFile::where('app_kind', 'press')
            ->where('app_id', $press->id)->get();
        $social_links =  json_decode($press->social_links);
        $comments = Comment::orderBy('created_at','desc')
            ->where('app_kind', 'press')
            ->where('app_id', $press->id)->get();

        return view('pages.press.show', compact('press', 'files', 'social_links', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $press = AppPress::where('id', $id)->first();
        $types = AppType::where('app_type', 'press')->get()->pluck('title', 'id');
        $social_links =  json_decode($press->social_links);

        return view('pages.press.edit', compact('types', 'press', 'social_links'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param UpdateAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id, UpdateAction $action)
    {
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

        return $action->run($request, $id);
    }
}
