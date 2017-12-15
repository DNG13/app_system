<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AppType;
use Illuminate\Support\Facades\Auth;

class AddTypeController extends Controller
{
    private $sortFields = [
        'id',
        'user_id',
        'app_type',
        'created_at',
        'title'
    ];
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $query = AppType::select('*')
            ->orderby($request->order_by ?? 'id', $request->order ?? 'asc');

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('title',  $keyword)
                    ->orWhere('app_type',  $keyword);
            });
        }

        $types = $query->paginate(10);
        return view('pages.type.index', ['types'=>$types, 'sort' => $this->prepareSort($request, $this->sortFields)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.type.create');
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
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);
        //store in database
        $type = new AppType();
        $type->title = $request->get('title');
        $type->app_type = $request->get('type');
        $type->user_id = Auth::user()->id;
        $type->created_at = Carbon::now();
        $type->save();
        return redirect('type');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = AppType::where('id', $id)->first();
        return view('pages.type.edit', compact('type'));
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
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);
        //store in database
        $type = AppType::where('id', $id)->first();
        $type->title = $request->get('title');
        $type->app_type = $request->get('type');
        $type->user_id = Auth::user()->id;
        $type->created_at = Carbon::now();
        $type->save();
        return redirect('type');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        AppType::where('id', $id)->delete();
        return redirect()->back();
    }
}
