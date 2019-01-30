<?php

namespace App;

class Lobby
{
    // объявление свойства
    public static $dir = '../public/js/node-dota2/examples/bot1/games/';
    public static $fullPath;

    static public function getPlayers($game_id)
    {
        $lobby = Room::find($game_id);
        $players = json_decode($lobby->players,true);

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