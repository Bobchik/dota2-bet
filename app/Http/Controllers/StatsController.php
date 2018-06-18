<?php

namespace App\Http\Controllers;

use App\Stat;
use App\Steam;

use App\User;
use Illuminate\Http\Request;
use Auth;

class StatsController extends Controller
{
    public $player_id;

    public function index()
    {
        $this->player_id = auth()->user()->player_id;
        $player_id32 = Steam::toSteamID($this->player_id);

        $user_info  = auth()->user();
        $user_stats = Stat::find($this->player_id);

        $recent_games = file_get_contents(
            "https://api.opendota.com/api/players/$player_id32/recentMatches"
        );
        $games = json_decode($recent_games, 1);

        return view(
            'personal.stats', compact('user_info', 'user_stats', 'games')
        );
    }
}
