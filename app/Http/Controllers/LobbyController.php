<?php

namespace App\Http\Controllers;

use App\Stat;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Lobby;
use App\Room;

class LobbyController extends Controller
{

    public $max;
    public $min_bet;
    public $rank;
    public $bank;
    public static $radiant_bets;
    public static $dire_bets;

    public function index($game_id)
    {
        $lobby = Room::find($game_id);
        $players = Lobby::getPlayers($game_id);
        $players = array_chunk($players, count($players)/2, true);

        $radiant = $players[0];
        $dire = $players[1];
        $bank = $lobby->bank;

        return view('lobby.index', compact('game_id','radiant', 'dire', 'bank'));
    }

    public function set($game_id, $place_id)
    {
        Lobby::takePlace($game_id,$place_id);

        return redirect()->action('LobbyController@index', ['game_id' => $game_id]);
    }

    public function bet($game_id, $bet)
    {
        $data = Lobby::makeBet($game_id,$bet);
        if(is_array($data)){
            $bet = $data['bet'];
            $coins = $data['coins'];
            $bank = $data['bank'];
            return response()->json(["bet" => $bet, "coins" => $coins, "bank" => $bank]);
        }
        else {
            return response()->json(['error' => 'Choose your team first'], 500); // Status code here
        }
    }

    public function leave()
    {
        Lobby::leaveRoom();

        return redirect()->action('RoomController@index');
    }

    public function start($game_id)
    {
        Lobby::startGame($game_id);

        $lobby = Room::find($game_id);
        $bank = $lobby->bank;

        $players = Lobby::getPlayers($game_id);
        $players = array_chunk($players, count($players)/2, true);

        $radiant = $players[0];
        $dire = $players[1];

        return view('lobby.start', compact('game_id', 'radiant', 'dire','bank'));

    }

    public function res($game_id)
    {
        $result = Lobby::checkDir($game_id);
        $str = file($result, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($str as $key => $value) {
            $arr = explode(' ', $value);
            if(current($arr) == "match_outcome"){
                $log[current($arr)] = next($arr);
                break;
            } else {
                $log['match_outcome'] = Room::IN_PROCESS;
            }
        }

        DB::table('rooms')->where('id', $game_id)->update(['winners' => $log['match_outcome']]);
        /*
            Получаем пользователей из БД
            для расспределения выиграша
        */
        $room = Room::find($game_id);
        $winners = $room->winners;

        $players = json_decode($room->players, true);
        $players = array_chunk($players, count($players)/2, true);

        $radiant = $players[0];
        $dire = $players[1];

        foreach ($radiant as $key => $value) {
            self::$radiant_bets += $value['bet'];
        }

        foreach ($dire as $key => $value) {
            self::$dire_bets += $value['bet'];
        }

        if($winners == 2){
            foreach ($radiant as $key => $player) {
                if($player['uid'] != 0){
                    $award = (round($player['bet'] / self::$radiant_bets, 2)) * self::$dire_bets;
                    $userStat = Stat::find($player['uid'])?:Stat::create(['user_id' => $player['uid']]);
                    DB::table('stats')->where('user_id', $player['uid'])->
                    update(['total_games' => DB::raw('total_games + 1'), 'win_games' => DB::raw('win_games + 1'),
                        'bet_win' => DB::raw("bet_win + $award")]);
                    DB::table('users')->where('player_id', $player['uid'])->
                    update(['coins'=> (request()->user()->where('player_id', $player['uid'])->value('coins') + $player['bet'] + $award)]);
                }
            }
            foreach ($dire as $key => $player) {
                if($player['uid'] != 0){
                    $userStat = Stat::find($player['uid'])?:Stat::create(['user_id' => $player['uid']]);
                    DB::table('stats')->where('user_id', $player['uid'])->
                    update(['total_games' => DB::raw('total_games + 1'), 'lose_games' => DB::raw('lose_games + 1'),
                        'bet_lose' => DB::raw("bet_lose +" . $player['bet'])]);
                }

            }
        }
        if($winners == 3){
            foreach ($radiant as $key => $player) {
                if($player['uid'] != 0){
                    $userStat = Stat::find($player['uid'])?:Stat::create(['user_id' => $player['uid']]);
                    DB::table('stats')->where('user_id', $player['uid'])->
                    update(['total_games' => DB::raw('total_games + 1'), 'lose_games' => DB::raw('lose_games + 1'),
                        'bet_lose' => DB::raw("bet_lose +" .$player['bet'])]);
                }
            }
            foreach ($dire as $key => $player) {
                if($player['uid'] != 0){
                    $award = (round($player['bet'] / self::$dire_bets, 2)) * self::$radiant_bets;
                    $userStat = Stat::find($player['uid'])?:Stat::create(['user_id' => $player['uid']]);
                    DB::table('stats')->where('user_id', $player['uid'])->
                    update(['total_games' => DB::raw('total_games + 1'), 'win_games' => DB::raw('win_games + 1'),
                        'bet_win' => DB::raw("bet_win + $award")]);
                    DB::table('users')->where('player_id', $player['uid'])->
                    update(['coins'=> (request()->user()->where('player_id', $player['uid'])->value('coins') + ($player['bet'] + $award))]);
                }
            }
        }
        return view('lobby.result',['winners' => $winners]);
    }
}
