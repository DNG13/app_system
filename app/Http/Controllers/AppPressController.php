<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppPress\StoreUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Actions\AppPress\StoreAction;
use App\Actions\AppPress\ListAction;
use App\Actions\AppPress\UpdateAction;
use App\Models\AppFile;
use App\Models\AppType;
use App\Models\AppPress;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Abstracts\Controller;

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
     * @param StoreUpdateRequest $request
     * @param StoreAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUpdateRequest $request, StoreAction $action)
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
        $press = AppPress::where('id', $id)->first();
        if($press->status == 'Отклонена' && !Auth::user()->isAdmin()){
            return redirect('press')->with('warning', 'Ваша заявка отклонена. Вы больше не можете её просматривать.');
        }
        $files = AppFile::where('app_kind', 'press')
            ->where('app_id', $press->id)->get();
        $social_links =  json_decode($press->social_links);
        $comments = Comment::orderBy('created_at','desc')
            ->where('app_kind', 'press')
            ->where('app_id', $press->id)->get();
        $members =  json_decode($press->members);
        $count = 0;

        return view('pages.press.show', compact('press', 'files', 'social_links', 'comments', 'members', 'count'));
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
        if($press->status == 'Отклонена' && !Auth::user()->isAdmin()){
            return redirect('press')->with('warning', 'Ваша заявка отклонена. Вы больше не можете её редактировать.');
        }
        $types = AppType::where('app_type', 'press')->get()->pluck('title', 'id');
        $social_links =  json_decode($press->social_links);
        $members =  json_decode($press->members);
        $count = 0;

        return view('pages.press.edit', compact('types', 'press', 'social_links', 'members', 'count'));
    }

    /**
     * @param StoreUpdateRequest $request
     * @param $id
     * @param UpdateAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUpdateRequest $request, $id, UpdateAction $action)
    {
        return $action->run($request, $id);
    }
}
