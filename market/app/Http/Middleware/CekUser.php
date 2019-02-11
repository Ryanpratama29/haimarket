<?php

namespace App\Http\Middleware;

use Closure;
use  Illuminate\Support\Facades\Auth as Auth;

class CekUser
{
   
    public function handle($request, Closure $next,$level)
    {
        $user = Auth::User();
        if($user && $user->level != $level){
            return redirect("{{route('login')}}");
        }

        else return $next($request);
    }
}
