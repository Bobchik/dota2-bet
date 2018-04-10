<?php

namespace App;
use Illuminate\Support\Facades\Cache;

class Lobby
{
    // объявление свойства
    public static $dir = '../storage/app/public/';
    public static $fullPath;

    static public function getPlayers($game_id)
    {
        if(Cache::has($game_id)){
            $lobby = cache($game_id);
            $players = $lobby[$game_id]['players'];
            $players = json_decode($players,true);
        }else{
/*            $newbie = cache('newbie');
            $players = json_decode($newbie[$game_id]['players'],true);
            Cache::forever($game_id,$players);*/
        }
        return $players;
    }

    static public function getLobby($game_id)
    {
        $lobbies = cache('newbie');
        $lobby = $lobbies[$game_id];

        return $lobby;
    }

  static public function lobbyBody()
    {
        for ($i = 1; $i <= 10; $i++) {
            $lobbies[$i] = ['type' => 0, 'bank' => 0, 'min_bet' => 0, 'max_bet' => 0, 'total' => 0];
        }
        return $lobbies;
    }

  static public function checkDir()
    {
        $files = scandir(self::$dir);
        foreach ($files as $file) {
            $check = preg_match('/^game_[0-9]+.mo/', $file);
            if ($check == 1) {
                $fileName       = $file;
                self::$fullPath = self::$dir . $fileName;

                return $fileName;
            }
        }
    }

    /*
        Генерируем индекс для названия файла
    */
    static public function newFile()
    {
        $today = date("Ymdgia");
        $gameName = "game_".$today;
        $fileName = $gameName. 'o.txt';

        return "/public/".$fileName;
    }

    static public function places()
    {
        if (self::checkDir() != null) {
            $str = file_get_contents(self::$fullPath);
            $str = str_replace("\n", "", $str);
            $arr = explode(' ', $str);
            array_pop($arr);
            for ($i = 0; $i < count($arr); $i += 2) {
                $playersID[$arr[$i + 1]] = $arr[$i];
            }

            return $playersID;
        } else {
            ($arr = 0);
        }
    }

}
	