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
                @foreach($lobbies as $room)
                    <tr>
                        <td>{{key($room)}}</td>
                        <td>{{$room[key($room)]['min_bet']}}</td>
                        <td>{{$room[key($room)]['max_bet']}}</td>
                        <td>{{$room[key($room)]['bank']}}</td>
                        <td>{{$room[key($room)]['count']}}</td>
                        <td><a href="../lobby/{{key($room)}}" style="text-decoration: none;">Играть</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection