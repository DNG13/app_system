<?php

namespace App\Http\Controllers;

use Auth;
use App\Actions\AppCosplay\ListAction;
use App\Actions\AppCosplay\StoreAction;
use App\Actions\AppCosplay\UpdateAction;
use App\Http\Requests\AppCosplay\IndexRequest;
use App\Models\AppType;
use App\Models\AppCosplay;
use App\Models\Comment;
use App\Models\AppFile;
use Illuminate\Http\Request;


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
        'members_count'
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

        return view('pages.cosplay.index',
            [
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
        $types = AppType::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        return view('pages.cosplay.create', ['types' => $types]);
    }

    /**
     * @param Request $request
     * @param StoreAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, StoreAction $action )
    {
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
        $cosplay = AppCosplay::where('id', $id)->first();
        $files = AppFile::where('app_kind', 'cosplay')
            ->where('app_id', $cosplay->id)->get();
        $comments = Comment::orderBy('created_at','desc')
            ->where('app_kind', 'cosplay')
            ->where('app_id', $cosplay->id)->get();
        $members =  json_decode($cosplay->members);
        $count = 0;

        return view('pages.cosplay.show', compact('cosplay', 'members', 'count', 'comments', 'files'));
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
        if($cosplay->status == 'Отклонена' && !Auth::user()->isAdmin()){
           return redirect('cosplay')->with('warning', 'Ваша заявка отклонена. Вы больше не можете её редактировать.');
        }
        $types = AppType::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        $members =  json_decode($cosplay->members);
        $count = 0;

        return view('pages.cosplay.edit', compact('types', 'cosplay', 'members', 'count'));
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
            'title' => 'required|string|max:255',
            'fandom' => 'required|string|max:255',
            'length' => 'required|numeric',
            'city' => 'required|string|max:100',
            'description' => 'required|string',
            'prev_part' => '',
            'comment' => '',
        ]);

        return $action->run($request, $id);
    }
}