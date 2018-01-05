<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppFair\StoreUpdateRequest;
use Auth;
use App\Actions\AppFair\ListAction;
use App\Actions\AppFair\StoreAction;
use App\Actions\AppFair\UpdateAction;
use App\Models\AppType;
use App\Models\AppFair;
use App\Models\AppFile;
use App\Models\Comment;
use Illuminate\Http\Request;
use Mail;

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
        'status'
    ];

    /**
     * @param Request $request
     * @param ListAction $action
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, ListAction $action)
    {
        $types = AppType::where('app_type', 'fair')->get()->pluck('title', 'id');
        $data = $request->all();

        return view('pages.fair.index', [
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
        $types = AppType::where('app_type', 'fair')->get()->pluck('title', 'id');
        return view('pages.fair.create', compact('types'));
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
        $fair = AppFair::where('id', $id)->first();
        $files = AppFile::where('app_kind', 'fair')
            ->where('app_id', $fair->id)->get();
        $equipment =  json_decode($fair->equipment);
        $comments = Comment::orderBy('created_at','desc')
            ->where('app_kind', 'fair')
            ->where('app_id', $fair->id)->get();
        $members =  json_decode($fair->members);
        $count = 0;

        return view('pages.fair.show', compact('fair', 'files', 'equipment', 'comments', 'members', 'count'));
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
        if($fair->status == 'Отклонена' && !Auth::user()->isAdmin()){
            return redirect('fair')->with('warning', 'Ваша заявка отклонена. Вы больше не можете её редактировать.');
        }
        $types = AppType::where('app_type', 'fair')->get()->pluck('title', 'id');
        $equipment =  json_decode($fair->equipment);
        $members =  json_decode($fair->members);
        $count = 0;

        return view('pages.fair.edit', compact('types', 'fair', 'equipment', 'members', 'count'));
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
