<header>
    <div class="logo1">
        <a href={{ asset("/profile") }}><img style="width: 100%" src={{ asset("img/LogoBG.png") }} alt=""></a>
    </div>
    <div class="actions">
        <a href="{{ url('rooms') }}" id="connect" class="action-sign">
            Присоедениться
        </a>
        <a href="{{ url('new_room') }}" id="create" class="action-sign">
            Создать
        </a>
    </div>
    <div class="right-bar">
        <div class="cash"><a href="#" id="cash" style="text-decoration:none; color: #F9E306; " data-toggle="modal"
                             data-target="#exampleStripe"><span
                        class="glyphicon glyphicon-plus"></span>Wallet: {{Auth::user()->coins}}</a></div>
        <a href="" class="profile"></a>
        <i class="fas fa-bell" style="color: aliceblue; font-size: 20px; margin-left: 20px;"></i>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="logout dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="fas fa-user" style="color: aliceblue; font-size: 20px; margin-left: 20px;"></i>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ url('/logout') }}" onclick="refresh()">
                        <i class="fa fa-btn fa-sign-out"></i>Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</header>

<!-- Modal -->
<div class="modal fade" id="exampleStripe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="exampleModalLabel">Refill your cash</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="{{ url('/checkout/stripe') }}" onclick="refresh()">
                    <img src="{{'/visa.jpg'}}" width="120px;" alt="">
                </a>
                {{--<a href="{{ url('/checkout/g2a') }}" onclick="refresh()">--}}
                    <img src="{{'/2303.png'}}" width="120px;" alt="">
                {{--</a>--}}
                <a href="{{ url('/checkout/webmoney') }}" onclick="refresh()">
                    <img src="{{'/04.jpg'}}" width="120px;" alt="">
                </a>
            </div>
        </div>
    </div>
</div>

<aside>
    <a href="{{ url('/profile/games') }}" class="agames">
        <i class="fas fa-gamepad"></i>
        <p>Игры</p>
    </a>
    <a href="{{ url('rooms') }}" class="agames">
        <i class="fas fa-th-list"></i>
        <p>Комнаты</p>
    </a>
    <a href="{{ url('stats') }}" class="agames">
        <i class="fas fa-trophy"></i>
        <p>Статистика</p>
    </a>
    <a href="" class="agames">
        <i class="fas fa-newspaper"></i>
        <p>Новости</p>
    </a>
</aside>