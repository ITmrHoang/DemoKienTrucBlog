<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckAdmin
{
    function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user()->hasAdmin()) {
            return redirect(\URL::previous())->with('erro', 'You can \'t role access this! You must be admin');;
        }

        return $next($request);
    }
}
