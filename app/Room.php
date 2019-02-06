<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Room extends Model
{

    public static $dir = '../storage/app/public/';
    public static $fullPath;
    protected $fillable = ['id', 'rank', 'bank', 'min_bet', 'max_bet', 'players'];
    public $timestamps = false;

    const FREE_ROOM = 0;
    const IN_PROCESS = 1;
    const RADIANT_WIN = 2;
    const DIRE_WIN = 3;

    /*
        Создание игры
    */
    static public function lobbyPlayers()
    {
        /*
            Исключить повторения
        */
        $players = [];
        for ($i = 1; $i <= 10; $i++) {
            $players[$i] = ['uid' => 0, 'bet' => 0, 'mmr' => 0, 'rank' => 0];
        }

        return $players;
    }

    /*
        key передаём имя поля которого
        хотим переписать
        data значение которое хотим
        записать
    */
    public static function set($game_id, $key, $data)
    {
        //$newbie = cache('newbie');
        $newbie                 = Cache::pull('newbie');
        $newbie[$game_id][$key] = $data;
        Cache::forever('newbie', $newbie);
    }

    //записываем это всё в базу
    public static function newRoom($request)
    {
        $totalPlayers = $request->get('players');
        $rank = $request->get('rank');
        $min_bet = $request->get('min_bet');
        $max_bet = $request->get('max_bet');

        $players=[];
        for ($i = 1; $i <= $totalPlayers; $i++) {
            $players[$i] = ['uid' => 0, 'bet' => 0, 'mmr' => 0, 'rank' => 0];
        }

        $id = date("YmdGis");

        $data[$id] = [
            'rank'    => $rank,
            'bank'    => 0,
            'min_bet' => $min_bet,
            'max_bet' => $max_bet,
            'players' => json_encode($players),
        ];

        Room::create([
            'id' =>$id,
            'rank' =>$rank,
            'bank' =>0,
            'min_bet' =>$min_bet,
            'max_bet' =>$max_bet,
            'players' =>json_encode($players),
        ]);

        return $data;
    }

    /*
        Получаем все свободные лобби по rank,
        из кэша, если их там нет берём из БД
        и записываем в кэш
    */
    public static function lobbyList($rank)
    {
        if (Cache::has($rank)) {
            $data = cache($rank);
        } else {
            $lobbies = DB::table('rooms')->get();
            foreach ($lobbies as $lobby) {
                $data[$lobby->id] = [
                    'rank'    => $lobby->rank,
                    'bank'    => $lobby->bank,
                    'min_bet' => $lobby->min_bet,
                    'max_bet' => $lobby->max_bet,
                    'players' => $lobby->players,
                ];
            }
            Cache::forever($rank, $data);
        }

        return $data;
    }

    static public function show($game)
    {
        if (self::checkDir() != null) {
            $str = file_get_contents(self::$dir . $game);
            $str = str_replace("\n", "", $str);
            $arr = explode(' ', $str);
            array_pop($arr);
            for ($i = 0; $i < count($arr); $i += 2) {
                $playersID[$arr[$i + 1]] = $arr[$i];
            }

            return $arr;
        } else {
            ($arr = 0);
        }
    }

}
