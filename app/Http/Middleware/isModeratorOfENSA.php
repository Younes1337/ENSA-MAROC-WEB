<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isModeratorOfENSA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = str_contains($request->path(), "ensa") ? $request->id : $request->e_n_s_a_id;
        $moderatorSENSA = $request->user()->e_n_s_a_id == $id;

        if($request->user()->hasRole("moderator") && $moderatorSENSA) {
            return $next($request);
        }
        return abort(401, "you have not the permission to make this operation");
    }
}
