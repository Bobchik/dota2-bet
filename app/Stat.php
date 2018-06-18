<?php

namespace App;

use phpQuery;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
            'user_id',
            'total_games',
            'win_games',
            'lose_games',
            'bet_lose',
            'bet_win'
        ];
        protected $primaryKey = 'user_id';
        public $timestamps = false;

    public function users()
    {
        return $this->belongsTo('App\User', 'player_id');
    }

    public static function getSteamTime()
    {
        $player_id = auth()->user()->player_id;

        $steam_time_request = file_get_contents(
            'https://steamcommunity.com/profiles/' . $player_id
        );
        $document = phpQuery::newDocument($steam_time_request);
        $test     = $document->find(".game_name:contains('Dota 2')")->parent();
        $time     = pq($test)->find('.game_info_details')->text();

        DB::table('users')->where('player_id', $player_id)->update(
            ['steam_time' => trim($time)]
        );
    }
}
