@extends('layouts.app')
@include('common.menu')

@section('content')
    <div class="games">
        <div class="games-row">
            <div class="games-img">
                <a href="{{ url('/rooms') }}"><img src={{asset("img/Games/dota2.jpg")}} alt=""></a>
                <div class="games-img-hover">Dota 2</div>
            </div>
            <div class="games-img">
                <img src={{ asset("img/Games/BlackSquad.jpg") }} alt="">
                <div class="games-img-hover">Black Squad</div>
            </div>
            <div class="games-img">
                <img src={{ asset("img/Games/CSGO.jpg") }} alt="">
                <div class="games-img-hover">CS GO</div>
            </div>
        </div>
        {{--<div class="games-row">--}}
            {{--<div class="games-img">--}}
                {{--<img src={{ asset("img/Games/Dota2.jpg") }} alt="">--}}
                {{--<div class="games-img-hover">Dota 2</div>--}}
            {{--</div>--}}
            {{--<div class="games-img">--}}
                {{--<img src={{asset("img/Games/dota2.jpg")}} alt="">--}}
                {{--<div class="games-img-hover">Dota 2</div>--}}
            {{--</div>--}}
            {{--<div class="games-img">--}}
                {{--<img src={{asset("img/Games/dota2.jpg")}} alt="">--}}
                {{--<div class="games-img-hover">Dota 2</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="games-row">--}}
            {{--<div class="games-img">--}}
                {{--<img src={{asset("img/Games/dota2.jpg")}} alt="">--}}
                {{--<div class="games-img-hover">Dota 2</div>--}}
            {{--</div>--}}
            {{--<div class="games-img">--}}
                {{--<img src={{asset("img/Games/dota2.jpg")}} alt="">--}}
                {{--<div class="games-img-hover">Dota 2</div>--}}
            {{--</div>--}}
            {{--<div class="games-img">--}}
                {{--<img src={{asset("img/Games/dota2.jpg")}} alt="">--}}
                {{--<div class="games-img-hover">Dota 2</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="games-row">--}}
            {{--<div class="games-img">--}}
                {{--<img src={{asset("img/Games/dota2.jpg")}} alt="">--}}
                {{--<div class="games-img-hover">Dota 2</div>--}}
            {{--</div>--}}
            {{--<div class="games-img">--}}
                {{--<img src={{asset("img/Games/dota2.jpg")}} alt="">--}}
                {{--<div class="games-img-hover">Dota 2</div>--}}
            {{--</div>--}}
            {{--<div class="games-img">--}}
                {{--<img src={{asset("img/Games/dota2.jpg")}} alt="">--}}
                {{--<div class="games-img-hover">Dota 2</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    @endsection