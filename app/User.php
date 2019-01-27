<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = [
		'name',
		'email',
		'password',
		'player_id',
        'coins',
        'rate',
        'morality'
	];

	protected $guarded = ['password'];

	public function stats()
    {
        return $this->hasOne('App\Stat', 'user_id');
    }

    public static function player_id($id)
    {
        if (strlen($id) > 10){
            $user = User::where('player_id', $id)->first();
        } else {
            $user = User::find($id);
        }
        return $user;
    }

    public static function get_mmr()
    {
        $player_id = auth()->user()->player_id;
        $player_id32 = Steam::toSteamID($player_id);

        $steam_data = file_get_contents(
            'https://api.opendota.com/api/players/' . $player_id32
        );

        $arr = json_decode($steam_data, 1);

        $rate = ($arr['solo_competitive_rank'] !== null) ? $arr['solo_competitive_rank'] : $arr['mmr_estimate']['estimate'];
        try {
            request()->user()->update(['rate' => $rate]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
