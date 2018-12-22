<?php

namespace App\Http\Controllers;

use App\Abstracts\Controller;
use App\Actions\File\GetFileAction;
use App\Actions\AppCosplay\ListAction;
use App\Actions\AppCosplay\StoreAction;
use App\Actions\AppCosplay\UpdateAction;
use App\Http\Requests\AppCosplay\StoreUpdateRequest;
use App\Models\Role;
use App\Models\AppType;
use App\Models\AppCosplay;
use App\Models\Comment;
use App\Models\AppFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppCosplayController extends Controller
{
    private $sortFields = [
        'id',
        'user_id',
        'type_id',
        'status',
        'created_at',
        'updated_at',
        'title',
        'fandom',
        'length',
        'city',
        'members_count',
        'group_nick'
    ];

    /**
     * @param Request $request
     * @param ListAction $action
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, ListAction $action)
    {
        $types = AppType::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        $data = $request->all();

        $count = ['accepted'=>0, 'rejected'=>0, 'processing'=>0];
        $apps = AppCosplay::all()->pluck('status');
        foreach ($apps as $app) {
            if($app == 'Принята') {
                $count['accepted']++;
            }
            if($app == 'Отклонена') {
                $count['rejected']++;
            }
            if($app == 'В обработке') {
                $count['processing']++;
            }
        }

        return view('pages.cosplay.index',
            [
                'applications' => $action->run($request),
                'sort' => $this->prepareSort($request, $this->sortFields),
                'types' => $types,
                'data' => $data,
                'count' => $count
            ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function create()
    {
        $types = AppType::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        $tempId = 'temp_' . Auth::user()->id . '_' . gmdate('Y-m-d H:i:s') . '' . uniqid();
        return view('pages.cosplay.create', ['types' => $types, 'tempId' => $tempId]);
    }

    /**
     * @param StoreUpdateRequest $request
     * @param StoreAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUpdateRequest $request, StoreAction $action )
    {
        return $action->run($request);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show($id)
    {
        $roles = Role::get();
        $cosplay = AppCosplay::where('id', $id)->first();
        if( is_null($cosplay) || ($cosplay->user_id !== Auth::user()->id && !Auth::user()->isAdmin())) {
            return redirect('cosplay');
        }
        $files = AppFile::where('app_kind', 'cosplay')
            ->where('app_id', $cosplay->id)->get();
        $comments = Comment::orderBy('created_at','asc')
            ->where('app_kind', 'cosplay')
            ->where('app_id', $cosplay->id)->get();
        $members = json_decode($cosplay->members);
        $count = 0;

        return view('pages.cosplay.show', compact('cosplay', 'members', 'count', 'comments', 'files', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cosplay = AppCosplay::where('id', $id)->first();
        if( is_null($cosplay) || ($cosplay->user_id !== Auth::user()->id && !Auth::user()->isAdmin())) {
            return redirect('cosplay');
        }
        if($cosplay->status == 'Отклонена' && !Auth::user()->isAdmin()){
           return redirect('cosplay')->with('warning', 'Ваша заявка отклонена. Вы больше не можете её редактировать.');
        }
        $files = AppFile::where('app_kind', 'cosplay')
            ->where('app_id', $cosplay->id)->get();
        $types = AppType::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        $members = json_decode($cosplay->members);
        $count = 0;

        return view('pages.cosplay.edit', compact('types', 'cosplay', 'members', 'count', 'files'));
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