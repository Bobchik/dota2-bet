<?php

namespace App\Http\Middleware;

use App\Room;
use Closure;

class LobbyMiddleware
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
        $id = $request->route()->parameter('id');
        $place = $request->route()->parameter('place');
        $steam_id = auth()->user()->player_id;
        $arr_ids = Room::show($id);
           // если есть такой ид на его место записываем 0
        if (array_search($steam_id, $arr_ids)) {
            $place = array_search($steam_id, $arr_ids);
            $arr_ids[$place] = 0;
        }
        // просто добавляем ид, проверка выше исключчает повторы
        $arr_ids[$place] = $steam_id;
        $str = '';
            foreach ($arr_ids as $key => $value) {
                $str .= $value . ' ' . $key . ' ';
            }

        $f = fopen(Room::$dir . $id, 'w+');
        $f = fwrite($f, $str);


        return $next($request);
    }
}
