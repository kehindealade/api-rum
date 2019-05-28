<?php

namespace Rumi\Http\Middleware;

use Closure;

class CheckOwnerRoomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ownerId = $request->owner_id;
        $roomerId = auth()->guard('roomer')->user()->id;


        if($ownerId == $roomerId){
            return response()->json(['error' => 'Sorry, you cannot order for a room you created']);
        }

        return $next($request);
    }
}
