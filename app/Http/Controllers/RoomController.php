<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Cache;

class RoomController extends Controller
{
    public function index()
    {   
//        Cache::flush();
        return view('rooms.index2');
    }

    public function create()
    {
        return view('rooms.create', compact(['id_player']));
    }

    public function set(Request $request)
    {   
        $players = $request->get('players');
        $rank = $request->get('rank');
        $min_bet = $request->get('min_bet');
        $max_bet = $request->get('max_bet');
        $lobby = Room::create($players,$rank, $min_bet, $max_bet);
        $game_id = strval(key($lobby));

        Cache::forever($game_id,$lobby);
        return redirect()->action('LobbyController@index', ['game_id' => $game_id]);
    }

    public function all($rank)
    {
     //Cache::flush();

        $ids = cache($rank);
        if ($ids == null){
            $lobbies = array();
        } else {
            $lobbies = Cache::many($ids);
            foreach ($lobbies as $key => $lobby) {
              // dd($lobbies);
              $players = json_decode($lobby[$key]['players'],true);
              $playersCount = 0;
              foreach ($players as $value) {
                if($value['uid'] != 0){
                  $playersCount++;
                }
            }
            $lobby[$key]['count'] = $playersCount;

            $lobbies[$key] = $lobby;

            }
          }
            usort($lobbies, function ($a, $b){
            if ($a[key($a)]['count'] == $b[key($b)]['count']) {
              return 0;
            }
            return ($a[key($a)]['count'] > $b[key($b)]['count']) ? -1 : 1;
            });
       // dd($lobbies);

        return view('rooms.all', ['lobbies' => $lobbies, 'rank' => $rank]);
    }

    /*
        Получаемвсех игроков в комнате.
        Если никого нет, создаём лобби.
    */
    public function get($game_id)
    {

        /*$players = cache($game_id) ?: Room::newLobby();
        for ($i=1; $i <= 10 ; $i++) { 
            $players[$i] = 0;
        }*/
        $players = Room::lobbyPlayers();
        
        for ($i = 1; $i <= 5; $i++) {
            $radiant[$i] = $players[$i];
        }
        for ($i = 6; $i <= 10; $i++) {
            $dire[$i] = $players[$i];
        }

        return view('rooms.get', compact(['dire', 'radiant','game_id']));
    }

    /*
        Смена места игрока в лобби
    */
    public function put($game_id,$place_id)
    {
        $players = cache($game_id) ?: Room::lobbyPlayers();
        $steam_id = auth()->user()->player_id;
        if (in_array($steam_id, $players)) {
            $key = array_search($steam_id, $players);
            $players[$key] = 0;
        }
        $players[$place_id] = $steam_id;

        Cache::forever($game_id,$players);

        return redirect()->action('LobbyController@index', ['game_id' => $game_id]);
    }

    public function start($game_id)
    {
        $content = 'var id = [';
        $players = cache($game_id);

        for ($i = 1; $i < 6; $i++) {
            $content .= "['$players[$i]'" . ',' . "'R'],";
        }
        for ($i = 6; $i < 11; $i++) {
            $content .= "['$players[$i]'" . ',' . "'D'],";
        }
        $content .= '];module.exports.id = id;';

       //return redirect()->action('RoomController@get',['game_id' => $game_id]);
    }
        
}
