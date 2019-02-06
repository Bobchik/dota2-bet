<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class Lobby
{
    // объявление свойства
    public static $dir = '../public/js/node-dota2/examples/bot1/games/';
    public static $fullPath;

    public static function getPlayers($game_id)
    {
        $lobby = Room::find($game_id);
        $players = json_decode($lobby->players, true);

        return $players;
    }

    public static function takePlace($game_id, $place_id)
    {
        $lobby = Room::find($game_id);
        $players = Lobby::getPlayers($game_id);
        $steam_id = auth()->user()->player_id;

        $place = array_search($steam_id, array_column($players, 'uid'));

        if ($place === 0 || $place) {
            return redirect()->action('LobbyController@index', ['game_id' => $game_id]);
        }

        //игрок($steam_id) занимает место($place_id) в лобби
        $players[$place_id]['uid'] = $steam_id;

        //увеличить банк комнаты и списать его со счёта пользователя
        $coins = auth()->user()->coins;
        $lobby->bank += $lobby->min_bet;
        $coins -= $lobby->min_bet;
        request()->user()->update(['coins' => $coins]);

        //увеличть ставку пользователя
        $players[$place_id]['bet'] += $lobby->min_bet;
        $lobby->players = json_encode($players);
        $lobby->save();
    }

    public static function makeBet($game_id, $bet)
    {
        $steam_id = auth()->user()->player_id;
        $lobby = Room::find($game_id);
        $players = Lobby::getPlayers($game_id);
        $coins    = auth()->user()->coins;

        $place = array_search($steam_id, array_column($players, 'uid'));

        if ($place === 0 || $place) {
            $bank = $lobby->bank + $bet;
            $lobby->bank = $bank;

            $coins -= $bet;
            request()->user()->update(['coins' => $coins]);

            $players[$place+1]['bet'] += $bet;
            $bet = $players[$place+1]['bet'];

            $lobby->players = json_encode($players);
            $lobby->save();

            return array('bet' => $bet,
                         'coins' => $coins,
                         'bank' => $bank);
        }else
            return false;
    }

    public static function leaveRoom()
    {
        $url_pr = url()->previous();
        $url_pr = parse_url($url_pr);
        $arr = explode('/', $url_pr['path']);

        if(isset($arr[2]) && $arr[2] == 'lobby'){
            $game_id = $arr[3];
            $lobby = Room::find($game_id);
            $players = Lobby::getPlayers($game_id);

            $steam_id = auth()->user()->player_id;
            $coins = auth()->user()->coins;

            $place = array_search($steam_id, array_column($players, 'uid'));
            if ($place == 0 || $place) {
                $lobby->bank -= $players[$place+1]['bet'] - $lobby->min_bet;

                request()->user()->update(['coins' => $coins + ($players[$place+1]['bet'] - $lobby->min_bet)]);
                $players[$place+1]['uid'] = 0;
                $players[$place+1]['bet'] = 0;
                $players[$place+1]['mmr'] = 0;
                $players[$place+1]['rank'] = 0;
            }
            $lobby->players = json_encode($players);
            $lobby->save();
        }
    }

    public static function startGame($game_id)
    {
        $lobby = Room::find($game_id);

        $players = Lobby::getPlayers($game_id);
        $players = array_chunk($players, count($players)/2, true);

        $radiant = $players[0];
        $dire = $players[1];

        $content = 'var id = [';

        foreach ($radiant as $key => $value) {
            $content .= '[\''.$value['uid'] . '\',' . "'R'],";
        }
        foreach ($dire as $key => $value) {
            $content .= '[\''.$value['uid'] . '\',' . "'D'],";
        }
        $content .= "['$game_id']];module.exports.id = id;";
        Storage::disk('bot')->makeDirectory("bot1/games/$game_id");
        Storage::disk('bot')->put("bot1/games/$game_id/$game_id.log", $game_id);
        Storage::disk('bot')->put("bot1/players.js", $content);

        $lobby->winners = Room::IN_PROCESS;
        $lobby->save();

        $rootDir = $_SERVER['DOCUMENT_ROOT'];

        $bot_path = "cd "
            . "js/node-dota2/examples/bot1 "
            . "&& node start.js >> $rootDir/js/node-dota2/examples/bot1/games/$game_id/$game_id.log &";

        $descriptorspec = array(
            0 => array("pipe", "r"),
            1 => array("pipe", "w")
        );

        proc_open($bot_path, $descriptorspec, $pipes);
    }

    public static function checkDir($game_id)
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