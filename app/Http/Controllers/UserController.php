<?php

namespace App\Http\Controllers;

use App\Game;
use App\Service;
use App\Stat;
use App\Steam;

use App\Http\Requests;
use App\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $user_info = auth()->user();
        $games = Game::all_games();
        $services = Service::all_services();

        return view('personal.index', compact('user_info', 'services', 'games'));
    }

    public function show($id)
    {
        $user_info = User::player_id($id);
        return view('personal.show', compact('user_info'));
    }

    public function update()
    {
        User::get_mmr();
        Stat::getSteamTime(auth()->user()->player_id);
        return back();
    }

    public function report_user($id)
    {
        $user = User::player_id($id);
        $user->morality = $user->morality - request()->value;
        $user->save();

        return response('User account has been reported!', '200');
    }
}
