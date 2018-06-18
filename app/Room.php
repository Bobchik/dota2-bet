<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    //protected $fillable = ['room_rank', 'min_bet', 'max_bet', 'bet', 'url'];
    /*
        public static function desc()
        {
            return static::selectRaw('*')
                ->orderBy('min_bet','desc')
                ->get()
                ->toArray();
        }

        public static function asc()
        {
            return static::selectRaw('*')
                ->orderBy('min_bet','asc')
                ->get()
                ->toArray();
        }

        public static function unsetBet()
        {
            $min_bet = request()->session()->get('min_bet');
            $bet = request()->session()->pull('bet');
            $user_coins = auth()->user()->coins;
            $coins = $user_coins + $bet - $min_bet;

            request()->user()->update([
                'coins' =>$coins
            ]);
        }*/
    public static $dir = '../storage/app/public/';
    public static $fullPath;
    protected $fillable
        = ['id', 'rank', 'bank', 'min_bet', 'max_bet', 'players'];

    /*
        Создание игры
    */
    static public function lobbyPlayers()
    {
        /*
            Исключить повторения
        */
        for ($i = 1; $i <= 10; $i++) {
            $players[$i] = ['uid' => 0, 'bet' => 0, 'mmr' => 0, 'rank' => 0];
        }

        /*Storage::append('/public/'.$fileName, $str);*/

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

    /*    public static function get($game_id, $key)
        {
            $newbie = cache($game_id);

            return $newbie[$game_id][$key];
        }*/

    public static function create($value, $rank, $min_bet, $max_bet)
    {
        for ($i = 1; $i <= $value; $i++) {
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

        $game_id = strval(key($data));

        $old   = cache($rank);
        $old[] = $game_id;
        Cache::forever($rank, $old);

        //Cache::forever($game_id, $data); 
        return $data;
    }

    /*
        Получаем все свободные лобби по rank,
        из кэша, если их там нет берём из БД
        и записываем в кэш
    */
    static public function lobbyList($rank)
    {
        /*       $today = date("YmdGis");
               //$fileName = $today. '_o';
               $players = json_encode(self::lobbyPlayers());
                      // $players = json_decode($players);
               for ($i = 1; $i <= 10; $i++) {
                   $lobbies[$today+$i] = ['rank' => $rank, 'bank' => 0, 'min_bet' => 0, 'max_bet' => 0, 'players' => $players];
                   DB::table('rooms')->insert(
                       ['id' =>$today+$i,
                        'rank' =>$lobbies[$today+$i]['rank'],
                        'bank' =>$lobbies[$today+$i]['bank'],
                        'min_bet' =>$lobbies[$today+$i]['min_bet'],
                        'max_bet' =>$lobbies[$today+$i]['max_bet'],
                        'players' =>$lobbies[$today+$i]['players'],
                       ]);
                }
                $lobbies = DB::table('rooms')->get();
                dd($lobbies);*/
        //$lobby = $newbie->where('id', $game_id)->toArray();
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
