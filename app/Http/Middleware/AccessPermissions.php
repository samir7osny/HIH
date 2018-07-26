<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class AccessPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$params)
    {
        $permission = false;
        foreach ($params as $key => $value) {
            if (    ($value == 'PRESIDENT' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->hihPresident)
                ||  ($value == 'MEMBER' && Auth::check() && Auth::user()->userInfo->isMember())
                ||  ($value == 'GUEST' && Auth::check() && !Auth::user()->userInfo->isMember())
                ||  ($value == 'HIGHBOARD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->isHighboard())
                ||  ($value == 'BOARD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->headOf)
                ||  ($value == 'TYPE_HEAD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->headOf && Auth::user()->userInfo->headOf->shortcut->shortcut == $params[$key + 1])
                ||  ($value == 'TYPE_MEMBER' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->committee && Auth::user()->userInfo->committee->shortcut->shortcut == $params[$key + 1])
                ||  ($value == 'COMMITTEE_HEAD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->headOf && Auth::user()->userInfo->headOf->id == $params[$key + 1])
                ||  ($value == 'EVENT_AUD' && Auth::check() && !Auth::user()->userInfo->isMember() && \App\EventEnrollment::where('event_id', $params[$key + 1])->where('guest_id', Auth::user()->userInfo->id)->first())
                ||  ($value == 'WORKSHOP_AUD' && Auth::check() && !Auth::user()->userInfo->isMember() && \App\WorkshopEnrollment::where('workshop_id', $params[$key + 1])->where('guest_id', Auth::user()->userInfo->id)->first())
                ||  ($value == 'TASK_HIGHBOARD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->isHighboard() && 
                    \App\User::find($params[$key + 1]) && \App\User::find($params[$key + 1])->userInfo->isMember() && !\App\User::find($params[$key + 1])->userInfo->isHighboard() && !\App\User::find($params[$key + 1])->userInfo->hihPresident)
                ||  ($value == 'TASK_BOARD' && Auth::check() && Auth::user()->userInfo->isMember() && Auth::user()->userInfo->headOf && 
                    \App\User::find($params[$key + 1]) && \App\User::find($params[$key + 1])->userInfo->isMember() && !\App\User::find($params[$key + 1])->userInfo->isHighboard() && !\App\User::find($params[$key + 1])->userInfo->hihPresident && !\App\User::find($params[$key + 1])->userInfo->headOf)
                ||  ($value == 'ANYONE')
                )
                $permission = true;
        }

        if (!$permission)
        {
            if($request->ajax())
                return response('You haven\'t the permission to do that!', 405);
            else
                return redirect('/')->with('error', 'You haven\'t the permission to do that!');
        }
        else
            return $next($request);
    }
}
