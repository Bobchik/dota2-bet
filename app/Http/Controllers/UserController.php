<?php

namespace App\Http\Controllers;

use App\Game;
use App\Report;
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
        $auth_user = auth()->user()->id;
        $check = Report::check_reporter($auth_user, $id);
        if ($check) {
            return back()->with('error', $check->getContent());
        }
        $user = User::find($id);
        $user->morality = $user->morality - 1;
        $user->save();

        return back()->with('response', 'User has been reported!');
    }
}
