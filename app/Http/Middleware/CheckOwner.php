<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Models\Post;
use Auth;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,Post $post)
    {
        if ( !$request->user()->hasAdmin || Auth::id() != $post->user_id  ) {
            return response()->eroo('erro' => 'ban khong co quyen') ;
        }
        return $next($request);
    }
}
