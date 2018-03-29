<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use phpQuery;
use App\Stat;
use App\Steam;

use Illuminate\Http\Request;
use Auth;

class StatsController extends Controller
{
    public function index()
    {
        $player_id   = auth()->user()->player_id;
        $player_id32 = Steam::toSteamID($player_id);

        $user_info  = auth()->user();
        $user_stats = Stat::all()->where('user_id', auth()->user()->id)->toArray(
        );

        $recent_games = file_get_contents(
            "https://api.opendota.com/api/players/$player_id32/recentMatches"
        );
        $games        = json_decode($recent_games, 1);

        return view(
            'personal.stats', compact('user_info', 'user_stats', 'games')
        );
    }

    public function getSteamTime()
    {
        $player_id = auth()->user()->player_id;

        $steam_time_request = file_get_contents(
            'http://steamcommunity.com/profiles/' . $player_id .'/games/?tab=all'
        );
        $steam_time_request = trim(preg_replace('/\s+/', ' ', $steam_time_request));
        $t = preg_match('#(570)#', $steam_time_request, $matches);

        if ($t != 0) {
            $steam_time = preg_match('/hours_forever":"(\d+\,\d+|\d+)/', $steam_time_request, $matches);
            $steam_time = explode('"', $matches[0]);

            DB::table('users')->where('player_id', $player_id)->update(
                ['steam_time' => $steam_time[2]]
            );
        }else{
            echo "Whoops, something get`s wrong!";
        }
    }

//    public static function getMatchStats($match_id)
//    {
//        $steam_match_details = file_get_contents('https://api.opendota.com/api/matches/'. $match_id);
//
//    }
}
