@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Your stats on service, {{$user_info->name}}</h4></div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Total games</th>
                                <th>Win games</th>
                                <th>Lose games</th>
                                <th>Win bet`s</th>
                                <th>Lose bet`s</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @if($user_stats)
                                    <td>{{$user_stats->total_games}}</td>
                                    <td>{{$user_stats->win_games}}</td>
                                    <td>{{$user_stats->lose_games}}</td>
                                    <td>{{$user_stats->bet_win}}</td>
                                    <td>{{$user_stats->bet_lose}}</td>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Recent games by {{$user_info->name}}</h4></div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Match ID</th>
                                <th>Duration</th>
                                <th>Game mode</th>
                                <th>Win</th>
                                <th>Kills</th>
                                <th>Deaths</th>
                                <th>Assist`s</th>
                                <th>XP per minute</th>
                                <th>Gold per minute</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($games as $value)
                                <tr>
                                    <td>{{$value['match_id']}}</td>
                                    <td>{{$value['duration']}}</td>
                                    <td>{{$value['game_mode']}}</td>
                                    <td>{{$value['radiant_win']}}</td>
                                    <td>{{$value['kills']}}</td>
                                    <td>{{$value['deaths']}}</td>
                                    <td>{{$value['assists']}}</td>
                                    <td>{{$value['xp_per_min']}}</td>
                                    <td>{{$value['gold_per_min']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

