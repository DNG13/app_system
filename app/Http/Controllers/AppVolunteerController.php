<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppVolunteer\StoreRequest;
use App\Http\Requests\AppVolunteer\UpdateRequest;
use Auth;
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
     * @param StoreRequest $request
     * @param StoreAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, StoreAction $action)
    {
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
        if($volunteer->status == 'Отклонена' && !Auth::user()->isAdmin()){
            return redirect('volunteer')->with('warning', 'Ваша заявка отклонена. Вы больше не можете её редактировать.');
        }
        $social_links =  json_decode($volunteer->social_links);
        return view('pages.volunteer.edit', compact('volunteer', 'social_links'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @param UpdateAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id, UpdateAction $action)
    {
        return $action->run($request, $id);
    }
}
