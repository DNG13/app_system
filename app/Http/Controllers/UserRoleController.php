<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use App\Models\UserRole;

class UserRoleController extends Controller
{
    private $sortFields = [
        'key',
        'user_id'
    ];
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users =  UserRole::all();

        $keyword = $request->get('search');
        $query = User::select('*')
            ->orderby($request->order_by ?? 'id', $request->order ?? 'asc');

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('usr_id',  $keyword);
            });
        }

        $roles = $query->paginate(10);
        return view('pages.user-role.index', ['roles'=>$roles, 'users'=>$users, 'sort' => $this->prepareSort($request, $this->sortFields)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user-role.create');
    }

    /**
     * @param StoreUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUpdateRequest $request)
    {
        $role = new UserRole();
        $role->key = $request->get('key');
        $role->save();

        return redirect('user-role');
    }

    /**\
     * @param $key
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($key)
    {
        $role = UserRole::where('key', $key)->first();
        return view('pages.user-role.edit', compact('role'));
    }

    /**
     * @param StoreUpdateRequest $request
     * @param $key
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StoreUpdateRequest $request, $key)
    {
        $role = UserRole::where('key', $key)->first();
        $role->key = $request->get('key');
        $role->save();

        return redirect('user-role');
    }
}
