<?php

namespace App\Http\Middleware;

use App\Lobby;
use App\Room;
use Illuminate\Support\Facades\Cache;
use Closure;

class LobbyPlace
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
        $url = url()->current();
        $url = parse_url($url);
    }
        return $next($request);
    }
}
