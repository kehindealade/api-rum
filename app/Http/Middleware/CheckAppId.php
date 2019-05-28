<?php

namespace Rumi\Http\Middleware;
use Rumi\ApiKeys;

use Closure;

class CheckAppId
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
        $appId = !empty($_SERVER['HTTP_X_API_KEY']) ? $_SERVER['HTTP_X_API_KEY'] : NULL;
        $webKey = ApiKeys::where('web', $appId)->get();

        if($appId == NULL){
            return response()->json([
                'error' => 'No api key was specified',
            ]);
        }else if(count($webKey) == 0){
            return response()->json([
                'error' => 'Wrong api key was specified',
            ]);
        }
        
        return $next($request);
    }
}
