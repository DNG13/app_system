<?php

namespace App\Http\Controllers;

use App\Actions\AppVolunteer\ListAction;
use App\Actions\AppVolunteer\StoreAction;
use App\Actions\AppVolunteer\UpdateAction;
use App\Models\AppVolunteer;
use App\Models\Comment;
use Illuminate\Http\Request;
use Mail;

class AppVolunteerController extends Controller
{
    private $sortFields = [
        'id',
        'user_id',
        'type_id',
        'status',
        'created_at',
        'updated_at',
        'nickname',
        'skills',
        'birthday',
        'city',
        'phone',
    ];

    /**
     * @param Request $request
     * @param ListAction $action
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, ListAction $action)
    {
        return view('pages.volunteer.index',
            ['applications' => $action->run($request), 'sort' => $this->prepareSort($request, $this->sortFields)]);
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
     * @param Request $request
     * @param StoreAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, StoreAction $action)
    {
        $this->validate($request,[
            'photo'=>'required|image|mimes:jpeg,jpg,png|max:4096',
            'surname' => 'required|string|max:64',
            'first_name' => 'required|string|max:64',
            'nickname' => 'max:64',
            'birthday' => 'required|date',
            'phone' => 'required|string|max:64',
            'city' => 'required|string|max:100',
            'social_links' => '',
            'skills' => 'required|string',
            'difficulties' => 'nullable|string',
            'experience' => 'nullable|string',
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
        $volunteer= AppVolunteer::where('id', $id)->first();
        $social_links =  json_decode( $volunteer->social_links);
        $comments = Comment::orderBy('created_at','desc')
            ->where('app_kind', 'volunteer')
            ->where('app_id', $volunteer->id)->get();

        return view('pages.volunteer.show', compact('volunteer', 'social_links', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $volunteer = AppVolunteer::where('id', $id)->first();
        $social_links =  json_decode($volunteer->social_links);
        return view('pages.volunteer.edit', compact('volunteer', 'social_links'));
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
            'photo'=>'nullable|image|mimes:jpeg,jpg,png|max:4096',
            'skills' => 'required|string',
            'difficulties' => 'nullable|string',
            'experience' => 'nullable|string',
            'surname' => 'required|string|max:64',
            'first_name' => 'required|string|max:64',
            'nickname' => 'max:64',
            'birthday' => 'required|date',
            'phone' => 'required|string|max:64',
            'city' => 'required|string|max:100',
            'social_links' => '',
        ]);

        return $action->run($request, $id);
    }
}
