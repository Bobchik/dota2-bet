<?php

namespace App\Http\Middleware;

use App\Room;
use Closure;

class LobbyBetMiddleware
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
        if (auth()->user()->coins <= 0) {
            abort('404', 'Not enough money');
        }elseif(auth()->user()->player_id == 0){
            abort('404', 'You must authorize at first');
        }
        return $next($request);
    }
}
