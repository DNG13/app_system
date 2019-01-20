<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppVolunteer\StoreRequest;
use App\Http\Requests\AppVolunteer\UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Actions\AppVolunteer\ListAction;
use App\Actions\AppVolunteer\StoreAction;
use App\Actions\AppVolunteer\UpdateAction;
use App\Models\AppVolunteer;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Abstracts\Controller;
use File;
use Illuminate\Support\Facades\Response;

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
        'difficulties',
        'age',
        'city',
    ];

    /**
     * @param Request $request
     * @param ListAction $action
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, ListAction $action)
    {
        $count = ['accepted'=>0, 'rejected'=>0, 'processing'=>0];
        $apps = AppVolunteer::all()->pluck('status');
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

        return view('pages.volunteer.index', [
            'applications' => $action->run($request),
            'sort' => $this->prepareSort($request, $this->sortFields),
            'count' => $count
        ]);
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
        if( is_null($volunteer) || ($volunteer->user_id !== Auth::user()->id && !Auth::user()->isAdmin())) {
            return redirect('volunteer');
        }
        $social_links = $volunteer->social_links;
        if(count(array_filter($social_links)) == 0) {
            $social_links = null;
        }
        $comments = Comment::orderBy('created_at','asc')
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
        if( is_null($volunteer) || ($volunteer->user_id !== Auth::user()->id && !Auth::user()->isAdmin())) {
            return redirect('volunteer');
        }
        if($volunteer->status == 'Отклонена' && !Auth::user()->isAdmin()){
            return redirect('volunteer')->with('warning', 'Ваша заявка отклонена. Вы больше не можете её редактировать.');
        }
        $social_links = $volunteer->social_links;
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

    /**
     * @param $id
     * @return mixed
     */
    public function getPhoto($id)
    {
        $file = AppVolunteer::where('id', $id)->get()->first();
        if (!$file) {
            throw new ModelNotFoundException();
        }

        $path = storage_path($file->photo);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
