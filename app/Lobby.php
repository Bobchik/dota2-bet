<?php

namespace App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Lobby
{
    // объявление свойства
    public static $dir = '../public/js/node-dota2/examples/bot1/games/';
    public static $fullPath;

    static public function getPlayers($game_id)
    {   
//        Cache::flush();
        if(Cache::has($game_id)){
            $lobby = cache($game_id);
            $players = $lobby[$game_id]['players'];
            $players = json_decode($players,true);
        }else{
            // $lobby = DB::table('rooms')->get()->where('id', $game_id);
            $lobby = Room::find($game_id);//->toArray();
            $data[$lobby->id] = [
                'rank' =>$lobby->rank,
                'bank' =>$lobby->bank,
                'min_bet' =>$lobby->min_bet,
                'max_bet' =>$lobby->max_bet,
                'players' =>$lobby->players,
                ];
            $players = $lobby->players;
            $players = json_decode($players,true);
/*            $newbie = cache('newbie');
            $players = json_decode($newbie[$game_id]['players'],true);*/
            Cache::forever($game_id,$data);
        }

        return $players;
    }

    static public function checkDir($game_id)
    {
        $files = scandir(self::$dir."/$game_id/");
        foreach ($files as $file) {
            $check = preg_match("/$game_id.end/", $file);
            if ($check == 1) {
                $fileName       = "$game_id/$file";
                return self::$dir.$fileName;
            }
        }
    }
}
	