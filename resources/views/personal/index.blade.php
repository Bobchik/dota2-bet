@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Your profile</div>

                    <div class="panel-body">
                        Hi {{$user_info->name}}. It's your profile page.
                        <br>Your e-mail: {{$user_info->email}}.
                        @if(!empty($user_info->player_id))
                            <br>Your Steam ID: {{$user_info->player_id}}
                        @endif
                        @if(!empty($user_info->rate))
                            <br>Your average MMR in Dota2: {{$user_info->rate}}
                        @endif
                        @if(!empty($user_info->steam_time))
                            <br>Current time in the Dota2: {{$user_info->steam_time}} hours
                        @endif
                        <br>Yout current morality on dota2-roulette: {{$user_info->morality}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Game</div>

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        @include('common.errors')
                        <div class="col-md-8">

                            <!-- New Form -->
                            <form action="{{ url('profile') }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="form-group col-md-8">
                                    <label for="service">Select service:</label>
                                    <select class="form-control" name="service">
                                        <option selected>Select service</option>
                                        @foreach($services as $item)
                                            <option value="{{$item['title']}}">{{$item['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-8">
                                    <label for="game">Select Game:</label>
                                    <select class="form-control " name="game">
                                        <option selected>Select game</option>
                                        @foreach($games as $item)
                                            <option value="{{$item['title']}}">{{$item['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            <form action="{{ url('auth/steam') }}" method="get" class="form-horizontal">
                                <!-- Sign up to Steam -->
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-plus"></i>Sign
                                            up to Steam
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('profile.update') }}" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" content="{{auth()->user()->id}}">
                                    <div class="col-sm-6">
                                        <button class="btn btn-default" type="submit">Update Dota2 MMR</button>
                                    </div>
                                </div>
                            </form>
                            @if(auth()->user()->id != $user_info->id)
                                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#exampleModal3">Report
                                    user</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div></div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel3">Choose reason, why you report this
                        user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group col-md-12">
                        <form action="#" method="post">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="col-md-3">
                            <label>Feed</label>
                            <input type="radio" name="report" value="1">
                            </div>
                            <div class="col-md-3">
                            <label>Insult</label>
                            <input type="radio" name="report" value="2">
                            </div>
                            <div class="col-md-3">
                            <label>Abuse</label>
                            <input type="radio" name="report" value="3">
                            </div>
                            <div class="col-md-3">
                            <label>Dno</label>
                            <input type="radio" name="report" value="4">
                            </div>
                            <button type="submit" class="btn btn-primary report-submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
