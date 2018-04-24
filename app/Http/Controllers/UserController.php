<?php

namespace App\Http\Controllers;

use App\Game;
use App\Service;
use App\Stat;
use App\Steam;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $user_info = auth()->user();

        $services  = Service::all();
        $games     = Game::all()->where('service_id', 1);

        return view('personal.index', compact('user_info', 'services', 'games'));
    }

    public function get($id){

        $user_info = User::find($id);

        $services  = Service::all();
        $games     = Game::all()->where('service_id', 1);

        return view('personal.index', compact('user_info', 'services', 'games'));
    }

    public function rate()
    {
        $player_id = auth()->user()->player_id;
        $player_id32 = Steam::toSteamID($player_id);

        $steam_data = file_get_contents(
            'https://api.opendota.com/api/players/' . $player_id32
        );
        $arr        = json_decode($steam_data, 1);
        if ($arr['solo_competitive_rank'] !== null) {
            request()->user()->update(
                ['rate' => $arr['solo_competitive_rank']]
            );
        } elseif(!empty($arr['mmr_estimate']['estimate'])) {
            request()->user()->update(
                ['rate' => $arr['mmr_estimate']['estimate']]
            );
        } else {
            return redirect('/profile/' . auth()->user()->id);
        }

        return redirect('/profile/' . auth()->user()->id);
    }

    public function report()
    {
        $user = User::find(request()->id);

        $user->morality = $user->morality - request()->value;
        $user->save();

        return response('User account has been reported!', '200');
    }
}
