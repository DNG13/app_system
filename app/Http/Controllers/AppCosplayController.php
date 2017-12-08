<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppCosplay\IndexRequest;
use App\Models\AppType;
use App\Models\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\AppCosplay;
use Illuminate\Http\Request;
use Mail;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $types = AppType::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        $data = $request->all();
        $keyword = $request->get('search');

        $query = AppCosplay::select('*')
            ->where('user_id', Auth::user()->id)
            ->orderby($request->order_by ?? 'id', $request->order ?? 'asc');

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'LIKE', "%$keyword%")
                    ->orWhere('fandom', 'LIKE', "%$keyword%")
                    ->orWhere('city', 'LIKE', "%$keyword%");
            });
        }

        if(!empty($request->get('type_id'))) {
            $query->where('type_id', $request->get('type_id'));
        }

        if(!empty($request->get('nickname'))) {
            $nickname = $request->get('nickname');
            $query->with('Profile')->whereHas('Profile', function($q) use ($nickname) {
                $q->where('nickname', 'LIKE', '%' . $nickname . '%');
            });
        }

        if(!empty($request->get('status'))) {
            $query->where('status', $request->get('status'));
        }

        if(!empty($request->get('ids'))) {
            $ids = array_map(function ($value) {
                return (int)trim($value);
            }, explode(',', $request->get('ids')));
            $query->whereIn('id', $ids);
        }

        $applications = $query->paginate(5);

        return view('pages.cosplay.index',
            [
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
        $types = AppType::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        return view('pages.cosplay.create', ['types' => $types]);
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
            'title' => 'required|string|max:255',
            'fandom' => 'required|string|max:255',
            'length' => 'required|numeric',
            'city' => 'required|string|max:100',
            'description' => 'required|string',
            'prev_part' => '',
            'comment' => '',
        ]);
        //store in database
        $cosplays = new AppCosplay();
        $cosplays->type_id = $request->get('type_id');
        $cosplays->title = $request->get('title');
        $cosplays->fandom = $request->get('fandom');
        $cosplays->length = $request->get('length');
        $cosplays->city = $request->get('city');
        $cosplays->description = $request->get('description');
        $cosplays->prev_part = $request->get('prev_part');
        $cosplays->comment = $request->get('comment');
        $cosplays->user_id = Auth::user()->id;
        $cosplays->status = 'В обработке';

        $members = [];
        foreach($request->input('members') as  $key => $value) {
            $members["member{$key}"] = $value;
        }
        $cosplays->members_count = count($members);
        $cosplays->members = json_encode($members);
        $cosplays->save();

        $user = User::where('id', Auth::user()->id)->get()->pluck('email');
        $mail[] = $user[0];
        Mail::send('mails.application',  $mail , function($message) use ( $mail ){
            $message->to( $mail[0]);
            $message->subject('Ваша заявка успешно отправлена');
        });
        return redirect('cosplay')->with('success', "Ваша заявка успешно отправлена.");;
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
        $comments = Comment::orderBy('created_at','desc')
            ->where('app_kind', 'cosplay')
            ->where('app_id', $cosplay->id)->get();
        $members =  json_decode($cosplay->members);
        $count = 0;
        return view('pages.cosplay.show', compact('cosplay', 'members', 'count', 'comments'));
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
        $types = AppType::where('app_type', 'cosplay')->get()->pluck('title', 'id');
        $members =  json_decode($cosplay->members);
        $count = 0;
        return view('pages.cosplay.edit', compact('types', 'cosplay', 'members', 'count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate the data
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
        //store in database
        $cosplays = AppCosplay::where('id', $id)->first();
        $cosplays->type_id = $request->get('type_id');
        $cosplays->title = $request->get('title');
        $cosplays->fandom = $request->get('fandom');
        $cosplays->length = $request->get('length');
        $cosplays->city = $request->get('city');
        $cosplays->description = $request->get('description');
        $cosplays->prev_part = $request->get('prev_part');
        $cosplays->comment = $request->get('comment');
        $cosplays->user_id = Auth::user()->id;
        $cosplays->status = 'В обработке';

        $members = [];
        foreach($request->input('members') as  $key => $value) {
            $members["member{$key}"] = $value;
        }
        $cosplays->members_count = count($members);
        $cosplays->members = json_encode($members);
        $cosplays->save();
        return redirect('cosplay');
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
