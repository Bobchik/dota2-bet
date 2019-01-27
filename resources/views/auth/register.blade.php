@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="text-center">
                <div>
                    <img src={{ asset("img/logo.png") }} class="modal_logo">
                </div>
                <form class="modal_form" role="form" method="POST" action="{{ url('/register') }}">
                    {!! csrf_field() !!}

                    <span class="modal_heading">Регистрация</span>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input type="text" name="name" placeholder="Name">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input type="text" name="email" placeholder="E-mail">

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input type="password" name="password" placeholder="Password">

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input type="password" name="password_confirmation" placeholder="Confirm password">

                    <button type="submit" class="button modal_btn">Зарегистрироваться</button>
                    <br>
                    <span class="modal_extra">Уже есть аккаунт?
                        <b class="open-popup-link" data-mfp-src="#sign_up"><a
                                    href="{{ url('/login') }}">Войти</a></b></span>
                </form>
            </div>
        </div>
    </div>
@endsection
