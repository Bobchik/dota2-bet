@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
            <h2>Choose your skill level</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Newbie
                    {{--<div class="card-title pricing-card-title pull-right">--}}
                        {{--<small class="text-muted">Min bet / </small>$4</div>--}}
                </div>
                <div class="panel-body">
                  <a href="{{'/rooms/list/newbie'}}" class="btn btn-primary">Enter</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Ordinary
                    {{--<div class="card-title pricing-card-title pull-right">--}}
                        {{--<small class="text-muted">Min bet / </small>$10</div>--}}
                </div>
                <div class="panel-body">
                    <a href="{{'/rooms/list/ordinary'}}" class="btn btn-primary">Enter</a>
                </div>
            </div>
        </div>
    </div><div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Expert
                    {{--<div class="card-title pricing-card-title pull-right">--}}
                        {{--<small class="text-muted">Min bet / </small>$25</div>--}}
                </div>
                <div class="panel-body">
                    <a href="{{'/rooms/list/expert'}}" class="btn btn-primary">Enter</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection