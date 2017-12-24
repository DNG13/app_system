<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreUpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Role;

class AddRoleController extends Controller
{
    private $sortFields = [
        'key',
        'title',
        'created_at',
        'active'
    ];
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $query = Role::select('*')
            ->orderby($request->order_by ?? 'key', $request->order ?? 'asc');

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('title',  $keyword)
                    ->orWhere('key',  $keyword);
            });
        }

        $roles = $query->paginate(10);
        return view('pages.role.index', ['roles'=>$roles, 'sort' => $this->prepareSort($request, $this->sortFields)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.role.create');
    }

    /**
     * @param StoreUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUpdateRequest $request)
    {
        $role = new Role();
        $role->title = $request->get('title');
        $role->key = $request->get('key');
        $role->active = $request->get('active');
        $role->created_at = Carbon::now();
        $role->save();

        return redirect('role');
    }

    /**\
     * @param $key
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($key)
    {
        $role = Role::where('key', $key)->first();
        return view('pages.role.edit', compact('role'));
    }

    /**
     * @param StoreUpdateRequest $request
     * @param $key
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StoreUpdateRequest $request, $key)
    {
        $role = Role::where('key', $key)->first();
        $role->title = $request->get('title');
        $role->key = $request->get('key');
        $role->active = $request->get('active');;
        $role->created_at = Carbon::now();
        $role->save();

        return redirect('role');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $key = $request->get('key');
        Role::where('key', $key)->delete();
        return redirect()->back();
    }
}
