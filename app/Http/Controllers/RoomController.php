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
        return view('rooms.index');
    }

    public function create()
    {
        return view('rooms.create', compact(['id_player']));
    }


    public function set(Request $request)
    {
        $lobby = Room::newRoom($request);
        $game_id = strval(key($lobby));
        return redirect()->action('LobbyController@index', ['game_id' => $game_id]);
    }

    public function all($rank)
    {
        $lobbies = Room::where('winners', Room::FREE_ROOM)->where('rank', $rank)->get();
        $inRoom = [];
        foreach ($lobbies as $lobby) {
            $players = json_decode($lobby->players, true);

            $playersCount = 0;
            foreach ($players as $player) {
                if($player['uid'] != 0){
                    $playersCount++;
                }
            }
            $inRoom[$lobby->id]= $playersCount;
        }

        return view('rooms.all', ['lobbies' => $lobbies,
            'rank' => $rank,
            'inRoom' => $inRoom]);
    }
}
