@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if($winners && $winners == 2)
                <h3 class="text-center">{{'Radiant win'}}</h3>
            @else
                <h3 class="text-center">{{'Dire win'}}</h3>
            @endif
        </div>
    </div>
@endsection
