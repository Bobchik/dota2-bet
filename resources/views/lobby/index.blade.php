@extends('layouts.app')
@include('common.menu')

@section('content')
    <div class="dota-img-teams-wrapper">
        <img class="dota-img" src={{ asset("img/MaskGroup38.png") }} alt="dota">
    </div>
    <div class="container">
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h3 class="text-center" style="color: white;">Текущий банк</h3>
                <div class="numbers-polzunok">
                    <div class="numbers">
                        <span id="bank">{{$bank}}$</span>
                    </div>
                </div>
                <div class="timer">
                    <p id="demo"></p>
                </div>

                <div class="stavka-buttons-wrapper">
                    <div class="timer-wrapper">
                        <p id="timer"></p>
                    </div>
                    <button id="exit" class="balance-btn" data-toggle="modal" data-target="#exampleModal2">Выйти
                    </button>
                    <button id="change" class="balance-btn" data-toggle="modal"
                            data-target="#exampleModal">Повысить
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-md-6">
            <div class="team-wrapper">
                <div class="team-1">
                    <h3 class="team-name">Команда 1</h3>
                    <ul class="list-group list-group-flush">
                        @foreach($radiant as $place_id => $playerID)
                            @if($playerID['uid'] == 0)
                                <li class="list-group-item round">
                                    <a class="take_place" href="/rooms/lobby/{{$game_id}}/place/{{$place_id}}">Take
                                        place</a>
                                </li>
                            @else
                                <li class="list-group-item round">
                                    @if(auth()->user()->player_id == $playerID['uid'])
                                        <span href="/rooms/lobby/{{$game_id}}/place/{{$place_id}}/set" class="place"
                                              id="button_{{ $place_id }}"></span>
                                    @endif
                                    | <a href="/profile/{{ $playerID['uid'] }}">{{ $playerID['uid'] }}</a> |
                                    <span id="bet_{{$playerID['uid']}}">{{ $playerID['bet'] }}</span>$
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-push-1">
            <div class="team-wrapper">
                <div class="team-1">
                    <h3 class="team-name">Команда 2</h3>
                    <ul class="list-group list-group-flush">
                        @foreach($dire as $place_id => $playerID)
                            @if($playerID['uid'] == 0)
                                <li class="list-group-item round">
                                    <a href="/rooms/lobby/{{$game_id}}/place/{{$place_id}}">Take place</a></li>
                            @else
                                <li class="list-group-item round">
                                    @if(auth()->user()->player_id == $playerID['uid'])
                                        <span href="/rooms/lobby/{{$game_id}}/place/{{$place_id}}/set" class="place"
                                              id="button_{{ $place_id }}"><i class="icon-ok"></i></span>
                                    @endif
                                    | <a href="/profile/{{$playerID['uid']}}">{{$playerID['uid']}}</a> |
                                    <span id="bet_{{$playerID['uid']}}">{{$playerID['bet']}}</span>$
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <a href="/rooms/lobby/{{$game_id}}/start" class="btn btn-success" id="start-game">Start game</a>
    </div>

    <div class="go"></div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Increase your bet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <meta name="lobby_id" content="{{$game_id}}">
                        <meta name="user_id" content="{{auth()->user()->player_id}}">
                        <div class="input-group col-md-9">
                            <label style="padding:12px ">Increase bet for: </label>
                            <button type="button" style="margin:5px" class="btn btn-primary bet_submit" value="1">1$
                            </button>
                            <button type="button" style="margin:5px" class="btn btn-primary bet_submit" value="2">2$
                            </button>
                            <button type="button" style="margin:5px" class="btn btn-primary bet_submit" value="5">5$
                            </button>
                            <button type="button" style="margin:5px" class="btn btn-primary bet_submit" value="10">10$
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel2">Вы потеряете минимальную ставку,
                        если покините комнату</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group col-md-10">
                        <label style="padding:12px ">Leave?</label>
                        <a href="/rooms/lobby/exit" style="margin:5px" class="btn btn-primary">YES
                        </a>
                        <button type="submit" style="margin:5px" class="btn btn-primary exit" value="no">NO
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function () {
            $('.place').on('click', function () {
                var id = $('.place').attr('id');
                var ready = document.getElementById(id);
                ready.innerHTML = "Ready!";
                ready.setAttribute("color:", "green");
                ready.setAttribute("class", "non-click");


                var link = document.getElementById(id).getAttribute("href");
                var room_id = link.split('/')[3];
                var place = link.split('/')[5];

                $.ajax({
                    type: "GET",
                    url: room_id + '/place/' + place + '/set'
                });
            });

            var timerId = setTimeout(function tick() {
                $.get(window.location.pathname + '/get', function (response) {
                    if (response.length >= 1) {
                        clearTimeout(timerId);
                        document.getElementById('change').setAttribute("style", "visibility: visible");
                        setTimeout(function () {
                            window.location.href = window.location.pathname + '/start';
                        }, 10000);
                    }
                });
                timerId = setTimeout(tick, 4000);
            }, 4000);
        };
    </script>
@endsection