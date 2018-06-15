@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('/new_room/set') }}" method="POST">
            {{csrf_field()}}
            <div class="container">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="players">Players</label>
                        <select name="players" class="form-control" id="players">
                            <option value="2">1x1</option>
                            <option value="10" selected="selected">5x5</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="rank">Type</label>
                        <select name="rank" class="form-control" id="rank">
                            <option value="newbie">Newbie</option>
                            <option value="ordinary">Ordinary</option>
                            <option value="expert">Expert</option>
                            <option value="private">Private</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="min_bet">Min Bet</label>
                        <select name="min_bet" id="min_bet" class="form-control">
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="max_bet">Max Bet</label>
                        <select name="max_bet" id="max_bet" class="form-control">
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </div>
        </form>
    </div>
@endsection
