@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if($winners && $winners == 2)
                <h3 class="text-center">{{'Radiant win'}}</h3>
            @elseif($winners && $winners == 3)
                <h3 class="text-center">{{'Dire win'}}</h3>
                @else
                <h3 class="text-center">{{'Match is still on'}}</h3>
            @endif
        </div>
    </div>
@endsection
