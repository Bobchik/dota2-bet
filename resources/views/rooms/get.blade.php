@extends('layouts.app')

@section('content')
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="card col-md-6">
            <div class="card-header">
                Radiant
            </div>
            <ul class="list-group list-group-flush">
                @foreach($radiant as $key => $playerID)
                    @if($playerID == 0)
                        <li class="list-group-item"><a href="/rooms/lobbi/{{$game_id}}/place/{{$key}}">Take place</a></li>
                    @else
                        <li class="list-group-item">{{$playerID}}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="card col-md-6">
            <div class="card-header">
                Dire
            </div>
            <ul class="list-group list-group-flush">
                @foreach($dire as $key => $playerID)
                    @if($playerID == 0)
                        <li class="list-group-item"><a href="/rooms/lobbi/{{$game_id}}/place/{{$key}}">Take place</a></li>
                    @else
                        <li class="list-group-item">{{$playerID}}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <a class="btn btn-success" href="/rooms/lobbi/{{$game_id}}/start">Start game</a>
    </div>

    <div class="go"></div>

@endsection