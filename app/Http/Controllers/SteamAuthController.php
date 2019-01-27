<?php

namespace App\Http\Controllers;

use App\Stat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Invisnik\LaravelSteamAuth\SteamAuth;
//use Exception;
use Auth;

class SteamAuthController extends Controller
{
    /**
     * The SteamAuth instance.
     *
     * @var SteamAuth
     */
    protected $steam;

    /**
     * The redirect URL.
     *
     * @var string
     */
    protected $redirectURL = '/profile';

    /**
     * AuthController constructor.
     *
     * @param SteamAuth $steam
     */
    public function __construct(SteamAuth $steam)
    {
        $this->steam = $steam;
    }

    /**
     * Redirect the user to the authentication page
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToSteam()
    {
        return $this->steam->redirect();
    }

    /**
     * Get user info and log in
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle()
    {
        if ($this->steam->validate()) {
            $info = $this->steam->getUserInfo();
            if (!is_null($info)) {
                $user = User::where('player_id', $info->steamID64)->first();
                if (!is_null($user)) {
                    return view('errors.500')->with('error', 'User with this player_id already registered');
                } else {
                    request()->user()->update(['player_id' => $info->steamID64]);
                    return redirect($this->redirectURL); // redirect to site
                }
            }
        }
        return $this->redirectToSteam();
    }
}
