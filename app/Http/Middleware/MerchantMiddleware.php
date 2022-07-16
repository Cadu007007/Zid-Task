<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class MerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth('sanctum')->check() && auth('sanctum')->user()->role == User::MERCHANT)
        {
            return $next($request);

        }
        throw new HttpResponseException(response()->json(['success'=>false,'errors'=>['permission'=>'You Don\'t Have Permission ']], 403)); 

    }
}
