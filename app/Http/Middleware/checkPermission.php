<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkPermission
{

    public function handle(Request $request, Closure $next, $permission)
    {
        $permission = explode('|', $permission);
        
        if(checkPermission($permission)){
            return $next($request);
        }


        return response()->json("Your can't access");
    }
}
