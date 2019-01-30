<?php
/**
 * Created by PhpStorm.
 * User: bobka
 * Date: 22.01.2019
 * Time: 07:14
 */

namespace App\Http\Controllers;


class GamesController
{
    public function index() {
        return view('personal.games');
    }
}