<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class hrhead
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
        if (    !(Auth::check() && Auth::user()->userInfo->headOf != null && Auth::user()->userInfo->headOf->shortcut->shortcut == 'HR')   ) {
            return redirect('/')->with('error', 'You haven\'t the permission to do that!');
        }
        return $next($request);
    }
}
