<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\Role;

class UserRoleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $query = User::with(['profile','roles']);
        $users = $query->paginate(10);
        return view('pages.user-role.index', ['users'=>$users]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user_roles = UserRole::where('user_id', $id)->get()->pluck('key');
        $userRoles = [];
        if(!is_null($user_roles)) {
            foreach ($user_roles as $role) {
                $userRoles[] = $role;
            }
        }
        $roles = Role::where('active', true)->get()->pluck('title', 'key');
        $user = Profile::where('user_id', $id)->first();
        return view('pages.user-role.edit', compact('userRoles', 'roles', 'user', 'id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update( Request $request)
    {
        $userRoles = UserRole::where('user_id', $request->get('id'))->get()->pluck('key') ?? null;
        $roles = [];
        foreach ($userRoles as $userRole) {
            $roles[] = $userRole;
        }
        $keys = $request->get('key');
        if(count($keys) == 0) {
            UserRole::where('user_id', $request->get('id'))->delete();
            return redirect('user-role');
        }
        elseif(count($keys) == 1 && !(in_array($keys, $roles))) {
                $newRole = new UserRole;
                $newRole->key = $keys[0];
                $newRole->user_id = $request->get('id');
                $newRole->save();
            return redirect('user-role');
        }else {
            foreach ($keys as $key) {
                if (!(in_array($key, $roles))) {
                    $newRole = new UserRole;
                    $newRole->key = $key;
                    $newRole->user_id = $request->get('id');
                    $newRole->save();
                }
            }
        }
        foreach ($roles as $role) {
            if (!(in_array($role, $keys))) {
                UserRole::where('key', $role)->delete();
            }
        }
        return redirect('user-role');
    }
}
