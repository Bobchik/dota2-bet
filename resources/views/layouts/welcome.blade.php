@extends('layouts.app')

@section('content')
    <section id="first" class="landing_block">
        <div class="landing_header">
            <a class="logo" href="#">
                <img src={{asset("img/logo_filled.png")}}>
            </a>
        </div>
        <div class="landing_content">
            <img src={{ asset("img/land_title.png") }} class="landing_title">
            <p class="landing_text">
                Играй в
                <b>CS:GO</b> и
                <b>Dota 2</b> с друзьями или с другими игроками за вознагрождение
            </p>
            <div class="button fs_btn open-popup-link" data-mfp-src="#sign_up"><a
                        style="text-decoration: none; color: #000;" href="{{ url('/login') }}">играть</a></div>
        </div>
        <svg class="landing_arrow" width="38" height="15" viewBox="0 0 38 15" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M18.8875 14.89C18.477 14.9137 18.0556 14.8115 17.6844 14.5704L0.91095 3.67761C-0.0154419 3.07599 -0.278687 1.83734 0.322876 0.911011C0.9245 -0.0153809 2.16315 -0.278687 3.08954 0.322937L18.8869 10.5818L34.6844 0.322876C35.6108 -0.278748 36.8494 -0.0154419 37.451 0.91095C38.0526 1.83728 37.7893 3.07599 36.863 3.67755L20.0895 14.5703C19.7186 14.8112 19.2976 14.9135 18.8875 14.89Z"
                  fill="white"/>
        </svg>
    </section>
    <section id="second" class="landing_block">
        <div class="landing_header">
            <a class="logo" href="#">
                <img src={{ asset("img/logo.png") }}>
            </a>
            <div class="button header_btn open-popup-link" data-mfp-src="#sign_in"><a
                        style="text-decoration: none; color: #000;" href="{{ url('/login') }}">играть</a></div>
        </div>
        <div class="advantages_block">
            <div class="advantage_item">
                <div class="icon_wrap">
                    <img class="no_hover" src={{ asset("img/icon.png") }}>
                    <img class="hover" src={{ asset("img/icon_hover.png") }}>
                </div>
                <p class="advantage_title">Просто</p>
                <p class="advantage_text">
                    Играйте, улучшайте свои навыки, следите за своими успехами, расширяйте свое кибер-сообщество и
                    организовывайте соревнования с друзьями или другими игроками. Ведь это не только весело, но ещё и
                    прибыльно.
                </p>
            </div>
            <div class="advantage_item">
                <div class="icon_wrap">
                    <img class="no_hover" src={{ asset("img/icon2.png") }}>
                    <img class="hover" src={{ asset("img/icon2_hover.png") }}>
                </div>
                <p class="advantage_title">Честно</p>
                <p class="advantage_text">
                    Система распределяет игроков таким образом, чтобы силы команд были максимально равными. А об
                    остальном позаботиться античит.
                </p>
            </div>
            <div class="advantage_item">
                <div class="icon_wrap">
                    <img class="no_hover" src={{ asset("img/icon3.png") }}>
                    <img class="hover" src={{ asset("img/icon3_hover.png") }}>
                </div>
                <p class="advantage_title">Безопасно</p>
                <p class="advantage_text">
                    Информация о том, какие средства безопастности предоставл€ет сервис для сохранности профиля игрока.
                </p>
            </div>
            <div class="advantage_item">
                <div class="icon_wrap">
                    <img class="no_hover" src={{ asset("img/icon4.png") }}>
                    <img class="hover" src={{ asset("img/icon4_hover.png") }}>
                </div>
                <p class="advantage_title">Выгодно</p>
                <p class="advantage_text">
                    Инфа о том, какой процент сервис берет от выигрыша победившей команды и о системах ввода и вывода
                    средств.
                </p>
            </div>
        </div>
        <svg class="landing_arrow reversed" width="38" height="15" viewBox="0 0 38 15" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M18.8875 14.89C18.477 14.9137 18.0556 14.8115 17.6844 14.5704L0.91095 3.67761C-0.0154419 3.07599 -0.278687 1.83734 0.322876 0.911011C0.9245 -0.0153809 2.16315 -0.278687 3.08954 0.322937L18.8869 10.5818L34.6844 0.322876C35.6108 -0.278748 36.8494 -0.0154419 37.451 0.91095C38.0526 1.83728 37.7893 3.07599 36.863 3.67755L20.0895 14.5703C19.7186 14.8112 19.2976 14.9135 18.8875 14.89Z"
                  fill="white"/>
        </svg>
    </section>
@endsection
