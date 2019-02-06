@extends('layouts.app')
@include('common.menu')

@section('content')
    <div class="dota-img-teams-wrapper">
        <img class="dota-img" src={{ asset("img/MaskGroup38.png") }} alt="dota">
    </div>
    <div class="container">
        <div class="table-wrapper">
            <h3 class="text-center" style="color: white;">Все комнаты уровня {{$rank}}:</h3>
            <table>
                <tr>
                    <th>ID комнаты</th>
                    <th>Мин. ставка</th>
                    <th>Макс. ставка</th>
                    <th>Банк</th>
                    <th>Кол-во игроков</th>
                    <th>Старт</th>
                </tr>
                @foreach($lobbies as $lobby)
                    <tr>
                        <td>{{$lobby->id}}</td>
                        <td>{{$lobby->min_bet}}</td>
                        <td>{{$lobby->max_bet}}</td>
                        <td>{{$lobby->bank}}</td>
                        <td>{{$inRoom[$lobby->id]}}</td>
                        <td><a href="../lobby/{{$lobby->id}}" style="text-decoration: none;">Играть</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection