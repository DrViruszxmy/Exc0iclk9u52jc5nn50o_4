<?php

namespace App\Http\Middleware;

use Closure;
use App\AccessList;
use Auth;
use Request;

class RedirectIfNoAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user()->user_id;
        $check = false;

        $accesses = AccessList::with('subModules.accessiblities')
                ->whereHas('subModules.accessiblities', function($query) use ($user){     
                    $query->where('users.user_id', $user);
                })
                ->get();

        foreach ($accesses as $access) {
            if (Request::path() == $access->active_class) {
                $check = true;
            }
        }

        if ($check || Request::path() == '/') {
            return $next($request);
        }

        abort(404, 'No way');
        
    }
}
