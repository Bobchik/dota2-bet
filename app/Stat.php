<?php

namespace App;

use App\Http\Controllers\Auth\SteamLogin;
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
    private static $time;

    public function users()
    {
        return $this->belongsTo('App\User', 'player_id');
    }

    public static function getSteamTime($player_id)
    {
        $cookie_file = dirname('tmp');
        $steam_login = new SteamLogin();
        $steam_login->geturl("https://store.steamcommunity.com", null , 0,  null, 0, $info, $output);
        $steam_login->geturl("https://store.steampowered.com/login/getrsakey/", null , 0,  array('username' => $steam_login->username,'donotcache' => time()), 0, $info, $output);
        $data = json_decode($output, true);
        if ($data['success'] === true)
        {
            $login = $steam_login->login($data);
            if ($login['success'] === true) {
                $file = file_get_contents($cookie_file . "/tmp/cookie_" . $player_id);
                $str = str_replace('store.steampowered.com', 'steamcommunity.com', $file);
                file_put_contents($cookie_file . "/tmp/cookie_" . $player_id, $str);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://steamcommunity.com/profiles/' . $player_id . '/games/?tab=all');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_COOKIEFILE, realpath($cookie_file) . "/tmp/cookie_" . $player_id);
                $output = curl_exec($ch);
                curl_close($ch);
                unlink(realpath($cookie_file) . "/tmp/cookie_" . $player_id);
            }
        }
        preg_match('/(rgGames)\s.*/', $output, $matches);
        $arr = explode("},{", $matches[0]);
        foreach ($arr as $items) {
            preg_match('/("appid":570).*/', $items, $item);
            preg_match('/("hours_forever":")\d*[,]?\d+/', $item[0], $value);
            if ($value[0]) {
               self::$time = $value[0];
               break;
            }
        }
        $time_arr = explode(":", self::$time);
        DB::table('users')->where('player_id', $player_id)->update(
            ['steam_time' => trim($time_arr[1], '"')]
        );
    }
}
