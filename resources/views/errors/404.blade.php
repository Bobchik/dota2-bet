@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="text-center">{{$exception->getMessage()}}</h1>
<h3 class="text-center"><a href="{{ url('/profile') }}">Your profile</a></h3>
</div>
@endsection