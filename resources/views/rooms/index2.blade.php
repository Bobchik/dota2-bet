@extends('layouts.app')
@include('common.menu')

@section('content')
<div class="dota-img-teams-wrapper">
    <img class="dota-img" src={{ asset("img/MaskGroup38.png") }} alt="dota">
</div>
    <div class="container">
        <div class="table-wrapper">
            <h3 class="text-center" style="color: white;">Выберите свой уровень</h3>
            <table>
                <tr>
                    <th>Название</th>
                    <th>Мин. ставка</th>
                    <th>Ранг</th>
                    <th>Кол-во комнат</th>
                    <th>Статус</th>
                    <th>Старт</th>
                </tr>
                <tr>
                    <td>Новичок</td>
                    <td>4$</td>
                    <td>50/100</td>
                    <td>20+</td>
                    <td>Активный</td>
                    <td><a href="{{'/rooms/list/newbie'}}" style="text-decoration: none;">Играть</a></td>
                </tr>
                <tr>
                    <td>Опытный</td>
                    <td>10$</td>
                    <td>100/200</td>
                    <td>20+</td>
                    <td>Активный</td>
                    <td><a href="{{'/rooms/list/ordinary'}}" style="text-decoration: none;">Играть</a></td>
                </tr>
                <tr>
                    <td>Профи</td>
                    <td>25$</td>
                    <td>200/500</td>
                    <td>20+</td>
                    <td>Активный</td>
                    <td><a href="{{'/rooms/list/expert'}}" style="text-decoration: none;">Играть</a></td>
                </tr>
            </table>
        </div>
        {{--<div class="row">--}}
            {{--<div class="col-md-10 col-md-offset-1 text-center">--}}
                {{--<h2 style="color: teal">Choose your skill level</h2>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-10 col-md-offset-1">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Newbie--}}
                        {{--<div class="card-title pricing-card-title pull-right">--}}
                        {{--<small class="text-muted">Min bet / </small>$4</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel-body">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-10 col-md-offset-1">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Ordinary--}}
                        {{--<div class="card-title pricing-card-title pull-right">--}}
                        {{--<small class="text-muted">Min bet / </small>$10</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--<a href="{{'/rooms/list/ordinary'}}" class="btn btn-primary">Enter</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-10 col-md-offset-1">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Expert--}}
                        {{--<div class="card-title pricing-card-title pull-right">--}}
                        {{--<small class="text-muted">Min bet / </small>$25</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--<a href="{{'/rooms/list/expert'}}" class="btn btn-primary">Enter</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection