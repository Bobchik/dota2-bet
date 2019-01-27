@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="text-center">
                <div>
                    <img src={{ asset("img/logo.png") }} class="modal_logo">
                </div>
                <form class="modal_form" role="form" method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}

                    <span class="modal_heading">Вход</span>

                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input type="email" name="email" placeholder="Email">

                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input type="password" name="password" placeholder="Password">

                    <button type="submit" class="button modal_btn">Войти</button>
                    <br>
                    <span class="modal_extra">Нет аккаунта? <b class="open-popup-link"><a href="{{ url('/register') }}">Зарегистрироваться</a></b></span>
                    <br>
                </form>
            </div>
        </div>
    </div>
@endsection
