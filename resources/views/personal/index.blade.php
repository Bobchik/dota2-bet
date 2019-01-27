@extends('layouts.app')
@include('common.menu')

@section('content')
    <div class="content">
        <div class="content-wrapper">
            <div class="left">
                <h2 class="user-profile-sign text-center">Профиль Пользователя</h2>
                <div class="profile">

                    <div class="photo-wrapper">
                        <img src={{ asset("img/User.png") }} alt="user" style="width: 250px">
                    </div>
                </div>
            </div>
            <ul class="list-group profile-list">
                <li class="list-group-item">Привет, {{$user_info->name}}. Это твой профиль.</li>
                <li class="list-group-item">Твой e-mail: {{$user_info->email}}.</li>
                @if(!empty($user_info->player_id))
                    <li class="list-group-item">Твой Steam ID: {{$user_info->player_id}}</li>
                @endif
                @if(!empty($user_info->rate))
                    <li class="list-group-item">Твой средний MMR in Dota2: {{$user_info->rate}}</li>
                @endif
                @if(!empty($user_info->steam_time))
                    <li class="list-group-item">Колличество времени в Dota2: {{$user_info->steam_time}} hours</li>
                @endif
                <li class="list-group-item">Текущий рейтинг на сервисе: {{$user_info->morality}}</li>
            </ul>
            <div class="balance">
                <div class="buttons">
                    <form action="{{ route('profile.update') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" content="{{auth()->user()->id}}">
                            <div class="col-sm-6">
                                <button class="balance-btn" type="submit">Обновить профиль</button>
                            </div>
                        </div>
                    </form>
                    <button data-toggle="modal" data-target="#exampleStripe" class="balance-btn">Пополнить баланс</button>
                    <a href="{{'/checkout/withdraw'}}" class="balance-btn" style="color:#000000; text-decoration: none;"> Обналичить</a>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="items">
                <span class="game-client-sign">Игровые клиенты</span>
                <div class="item-wrapper">
                    <i class="fab fa-steam-square icon-item"></i>
                    <div class="sign-btn-wrapper">
                        <p class="item-sign">Steam NickName</p>
                        <form action="{{ url('auth/steam') }}" method="get" class="form-horizontal">
                            <!-- Sign up to Steam -->
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="item-btn">Играть</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="item-wrapper">
                    <div class="item-img-wrapper">
                        <img src={{ asset("img/Uplay.png") }} alt="uplay">
                    </div>

                    <div class="sign-btn-wrapper">
                        <p class="item-sign">Uplay NickName</p>
                        <button class="item-btn">Играть</button>
                    </div>
                </div>
                <div class="item-wrapper">
                    <div class="item-img-wrapper">
                        <img src={{ asset("img/BattleNet.png") }} alt="uplay">
                    </div>
                    <div class="sign-btn-wrapper">
                        <p class="item-sign">BattleNet NickName</p>
                        <button class="item-btn">Играть</button>
                    </div>
                </div>
                <div class="item-wrapper">
                    <div class="item-img-wrapper">
                        <img src={{ asset("img/Origin.png") }} alt="uplay">
                    </div>
                    <div class="sign-btn-wrapper">
                        <p class="item-sign">Origin NickName</p>
                        <button class="item-btn">Играть</button>
                    </div>
                </div>
                <div class="item-wrapper">
                    <div class="item-img-wrapper">
                        <img src={{ asset("img/gog.png") }} alt="uplay">
                    </div>
                    <div class="sign-btn-wrapper">
                        <p class="item-sign">GogCom NickName</p>
                        <button class="item-btn">Играть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="game_block">--}}
        {{--<h3>Игры</h3>--}}
        {{--<div class="games_list">--}}
            {{--<a href="#" style="background-image: url(../img/game1.png)" class="game_item">--}}
                {{--<div class="game_item_hover">--}}
                    {{--<span class="hover_game">Dota 2</span>--}}
                    {{--<span class="hover_count">1245 игроков</span>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a href="#" style="background-image: url(img/game2.png)" class="game_item">--}}
                {{--<div class="game_item_hover">--}}
                    {{--<span class="hover_game">CS: GO</span>--}}
                    {{--<span class="hover_count">1245 игроков</span>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a href="#" style="background-image: url(img/game3.png)" class="game_item">--}}
                {{--<div class="game_item_hover">--}}
                    {{--<span class="hover_game">Hearthstone</span>--}}
                    {{--<span class="hover_count">1245 игроков</span>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a href="#" style="background-image: url(img/game4.png)" class="game_item">--}}
                {{--<div class="game_item_hover">--}}
                    {{--<span class="hover_game">PUBG</span>--}}
                    {{--<span class="hover_count">1245 игроков</span>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a href="#" style="background-image: url(img/game5.png)" class="game_item">--}}
                {{--<div class="game_item_hover">--}}
                    {{--<span class="hover_game">BS</span>--}}
                    {{--<span class="hover_count">1245 игроков</span>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
            {{--<div class="col-md-10 col-md-offset-1">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Your profile</div>--}}

                    {{--<div class="panel-body">--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-10 col-md-offset-1">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Add Game</div>--}}

                    {{--<div class="panel-body">--}}
                        {{--<!-- Display Validation Errors -->--}}
                        {{--@include('common.errors')--}}
                        {{--<div class="col-md-8">--}}

                            {{--<!-- New Form -->--}}
                            {{--<form action="{{ url('profile') }}" method="POST" class="form-horizontal">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<div class="form-group col-md-8">--}}
                                    {{--<label for="service">Select service:</label>--}}
                                    {{--<select class="form-control" name="service">--}}
                                        {{--<option selected>Select service</option>--}}
                                        {{--@foreach($services as $item)--}}
                                            {{--<option value="{{$item['title']}}">{{$item['title']}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}

                                {{--<div class="form-group col-md-8">--}}
                                    {{--<label for="game">Select Game:</label>--}}
                                    {{--<select class="form-control " name="game">--}}
                                        {{--<option selected>Select game</option>--}}
                                        {{--@foreach($games as $item)--}}
                                            {{--<option value="{{$item['title']}}">{{$item['title']}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</form>--}}


                            {{--@if(auth()->user()->id != $user_info->id)--}}
                                {{--<a class="btn btn-danger" href="#" data-toggle="modal" data-target="#exampleModal3">Report--}}
                                    {{--user</a>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div></div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"--}}
         {{--aria-hidden="true">--}}
        {{--<div class="modal-dialog" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<h5 class="modal-title text-center" id="exampleModalLabel3">Choose reason, why you report this--}}
                        {{--user</h5>--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<div class="input-group col-md-12">--}}
                        {{--<form action="#" method="post">--}}
                            {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
                            {{--<div class="col-md-3">--}}
                            {{--<label>Feed</label>--}}
                            {{--<input type="radio" name="report" value="1">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-3">--}}
                            {{--<label>Insult</label>--}}
                            {{--<input type="radio" name="report" value="2">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-3">--}}
                            {{--<label>Abuse</label>--}}
                            {{--<input type="radio" name="report" value="3">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-3">--}}
                            {{--<label>Dno</label>--}}
                            {{--<input type="radio" name="report" value="4">--}}
                            {{--</div>--}}
                            {{--<button type="submit" class="btn btn-primary report-submit">Submit</button>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
