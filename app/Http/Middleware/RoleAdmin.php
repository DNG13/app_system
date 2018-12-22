<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class RoleAdmin
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * RoleAdmin constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();
        if (!$user) {
            return redirect('login');
        }
        if (!array_intersect($user->roles->pluck('key')->toArray(), User::ADMIN_ROLES)) {
            return redirect('home');
        }

        return $next($request);
    }
}
