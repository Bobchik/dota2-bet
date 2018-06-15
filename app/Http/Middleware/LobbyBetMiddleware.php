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
        $arr = explode('/', $request->getPathInfo());
        $game_id = $arr[3];
        $lobby = cache($game_id);
        $min_bet = $lobby[$game_id]['min_bet'];

        if (auth()->user()->coins < $min_bet) {
            abort('404', 'Not enough money');
        }elseif(auth()->user()->player_id == 0){
            abort('404', 'You must authorize at first');
        }
        return $next($request);
    }
}
