<?php

namespace App\Http\Controllers;

use App\Http\Requests\Type\StoreUpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AppType;
use Illuminate\Support\Facades\Auth;
use App\Abstracts\Controller;

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

        $types = $query->paginate(20);
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
     * @param StoreUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUpdateRequest $request)
    {
        $type = new AppType();
        $type->title = $request->get('title');
        $type->app_type = $request->get('type');
        $type->user_id = Auth::user()->id;
        $type->created_at = Carbon::now();
        $type->save();

        return redirect('type');
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
        if( is_null($type)){
            return redirect('type');
        }
        return view('pages.type.edit', compact('type'));
    }

    /**
     * @param StoreUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StoreUpdateRequest $request, $id)
    {
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
