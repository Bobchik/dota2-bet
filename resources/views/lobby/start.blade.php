@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h2>You have been invited in the game, good luck!</h2>
                <h3>Current bank in this game {{$bank}}$</h3>
        </div>
    </div>
     <div class="container">
        <div class="card col-md-6">
            <div class="card-header">
                Radiant
            </div>
            <ul class="list-group list-group-flush">
                @foreach($radiant as $place_id => $playerID)
                    @if($playerID['uid'] == 0)
                        <li class="list-group-item"><a href="/rooms/lobby/{{$game_id}}/place/{{$place_id}}">Take place</a></li>
                    @else
                        <li class="list-group-item">{{$playerID['uid']}} | <span id="bet">{{$playerID['bet']}}</span>$</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="card col-md-6">
            <div class="card-header">
                Dire
            </div>
            <ul class="list-group list-group-flush">
                @foreach($dire as $place_id => $playerID)
                    @if($playerID['uid'] == 0)
                        <li class="list-group-item"><a href="/rooms/lobby/{{$game_id}}/place/{{$place_id}}">Take place</a></li>
                    @else
                       <li class="list-group-item">{{$playerID['uid']}} | <span id="bet">{{$playerID['bet']}}</span>$</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <a class="btn btn-success" href="results">Get score</a>
    </div>
@endsection
