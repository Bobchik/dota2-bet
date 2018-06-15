@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-9">
            <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                    Rooms filter
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="?asc=1">Filter by bet`s(asc)</a></li>
                    <li><a href="?desc=1">Filter by bet`s(desc)</a></li>
                    <li><a href="#">Filter by free places</a></li>
                </ul>
            </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2 class="text-center">Choose the room where you want to play</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-9">
                @if(array_key_exists('desc', $_GET))
                    @foreach($desc as $room)
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ucfirst($room['room_rank'])}}
                                - {{' Min bet: $'. $room['min_bet']}}</div>
                            <div class="panel-body">
                                <a class="btn btn-success" href="{{$room['url']}}">Enter</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach($asc as $room)
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ucfirst($room['room_rank'])}}
                                - {{' Min bet: $'. $room['min_bet']}}</div>
                            <div class="panel-body">
                                <a class="btn btn-success" href="{{$room['url']}}">Enter</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Test</div>
                    <div class="panel-body">
                        <li class=""></li>
                        <li class=""></li>
                        <li class=""></li>
                        <li class=""></li>
                        <li class=""></li>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
