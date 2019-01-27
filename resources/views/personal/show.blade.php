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
                <li class="list-group-item">Пользователь - {{$user_info->name}}.</li>
                <li class="list-group-item">E-mail: {{$user_info->email}}.</li>
                @if(!empty($user_info->player_id))
                    <li class="list-group-item">Steam ID: {{$user_info->player_id}}</li>
                @endif
                @if(!empty($user_info->rate))
                    <li class="list-group-item">Cредний MMR in Dota2: {{$user_info->rate}}</li>
                @endif
                @if(!empty($user_info->steam_time))
                    <li class="list-group-item">Колличество времени в Dota2: {{$user_info->steam_time}} hours</li>
                @endif
                <li class="list-group-item">Текущий рейтинг на сервисе: {{$user_info->morality}}</li>
            </ul>
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
@endsection
