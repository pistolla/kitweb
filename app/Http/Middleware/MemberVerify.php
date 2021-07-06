<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Member;

class MemberVerify
{
   
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            if(Auth()->guard('feed')->user()->status == '1' && Auth()->guard('feed')->user()->emailv == 1 && Auth()->guard('feed')->user()->smsv == 1)
            {
                 return $next($request);
            }
            else
            {
                return redirect()->route('feed.verify');
            }
        }
    }
}
