<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FacilitatorAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('api')->check() && $request->user()->type >= 2)
        {
            return $next($request);
        } else {
            $message = ["message" => "Permission Denied"];
            return response($message, 401);
        }

    }
}
