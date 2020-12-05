<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class IsOwner
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
        $userId = Session::get('userId');
        $userID = $request->id;
        if ($userId == $userID) {
            return $next($request);
        }
        return abort(401);
    }
}
