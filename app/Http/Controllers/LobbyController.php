<?php

namespace App\Http\Controllers;

use App\Bet;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Lobby;

class LobbyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

/*
    Индексный метод - будет как метод создания лобби
        без проверок (ну или назову его креате)

    Все проверки вынести в отдельный метод шоув
        (ну или индекс если индекс будет креате)

    Если чувак создаёт лобби он выбирает колво игроков (100% кратное 2)
    Ставки хз

    Режимы кастомные
    5х5, 1x1 я думаю этого хватит

    Все лобби пробуем в БД вместо файликов
        -лобби ид
         или даер и радиант - я думаю лучше
         или 10 чуваков - тоже норм
         статус лобби - идёт игра/набор/конец
*/
    public function index($min_bet)
    {
        $players = session('players')? session('players') : 10;
        switch ($min_bet) {
            case 'newbie':
                $min_bet = 2;
                break;
            case 'ordinary':
                $min_bet = 4;
                break;
            case 'expert':
                $min_bet = 10;
                break;
        }

        if (auth()->user()->coins < $min_bet
            || auth()->user()->player_id == 0
        ) {
            return redirect('/personal')->withErrors(
                'Not enough money or you haven`t game id'
            );
        }

        session(['min_bet' => $min_bet]);

        $arrIDs = Lobby::places();

        //Генерим новый файл, если их нет и записываем ид
        if (empty($arrIDs)) {
            $str = '';
            for ($i = 1; $i <= $players; $i++) {
                $str .= '0 ' . $i . ' ';
            }
        Storage::append(Lobby::newFile(), $str);
        }
        for ($i = 1; $i <= $players/2; $i++) {
            $radiant[$i] = $arrIDs[$i];
        }
        for ($i = count($radiant)+1; $i <= $players; $i++) {
            $dire[$i] = $arrIDs[$i];
        }

        return view(
            'lobby.index', compact(['dire', 'radiant', 'coins'])
        );
    }


    public function get()
    {
        $room_cash = DB::table('bets')->select('bet')->where(
            'room_rank', session()->get('rank')
        )->first();

        $content = 'var id = [';
        $arrIDs = Lobby::places();
        for ($i = 1; $i < 6; $i++) {
            $content .= "['$arrIDs[$i]'" . ',' . "'R'],";
        }
        for ($i = 6; $i < 11; $i++) {
            $content .= "['$arrIDs[$i]'" . ',' . "'D'],";
        }
        $content .= '];module.exports.id = id;';
        Storage::append('public\\players.js', $content);
        Storage::move(
            'public\\' . Lobby::checkDir(),
            'public\\c' . Lobby::checkDir()
        );
        $str = '';
        for ($i = 1; $i <= 10; $i++) {
            $str .= "0 $i ";
        }
        Storage::append(Lobby::newFile(), $str);

        for ($i = 1; $i < 6; $i++) {
            $radiant[$i] = $arrIDs[$i];
        }
        for ($i = 6; $i < 11; $i++) {
            $dire[$i] = $arrIDs[$i];
        }

        //Выводит логи,
        $bot_path = "cd "
            . "js/node-dota2/examples"
            . "&& node start.js >> /home/vagrant/code/auth/storage/app/public/log/dota2.log &";
//            . "&& node start.js >> /home/vagrant/code/auth/dota2-roulette/storage/app/public/log/dota2.log &";
       // $bot_path = "ps -ef | grep node";
        exec($bot_path, $out, $err);
      //  dd($out);

        return view('lobby.start', compact('dire', 'radiant', 'room_cash'));
    }

    public function team($id)
    {
        $steam_id = auth()->user()->player_id;
        $arrIDs = Lobby::places();
        // если есть такой ид на его место записываем 0
        if (in_array($steam_id, $arrIDs)) {
            $key = array_search($steam_id, $arrIDs);
            $arrIDs[$key] = 0;
        }
        // просто добавляем ид, проверка выше исключчает повторы
        $arrIDs[$id] = $steam_id;
        $str = '';
        foreach ($arrIDs as $key => $value) {
            $str .= $value . ' ' . $key . ' ';
        }

        $f = fopen(Lobby::$dir . Lobby::checkDir(), 'w+');
        $f = fwrite($f, $str);

        return back();
    }

    public function res()
    {
//        $lines = file('/home/vagrant/code/auth/public/js/node-dota2/examples/match.end25510595590304912');
        $lines = file('/home/vagrant/code/auth/public/js/node-dota2/examples/match1.end');
        //$fs = fopen("/home/vagrant/code/auth/public/js/node-dota2/examples/match.end25510595586138574", 'r+');
        dd($lines);
    }
}
