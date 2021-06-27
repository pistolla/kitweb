<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Publisher;

class PublisherVerify
{
   
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            if(Auth()->guard('publisher')->user()->status == '1' && Auth()->guard('publisher')->user()->emailv == 1 && Auth()->guard('publisher')->user()->smsv == 1)
            {
                 return $next($request);
            }
            else
            {
                return redirect()->route('publisher.verify');
            }
        }
    }
}
