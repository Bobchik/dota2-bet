@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h1 class="text-center">Leave your request</h1>
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table">
                    <div class="row display-tr">
                        <h4 class="panel-title display-td text-center">Withdraw information</h4>
                    </div>
                </div>
                <div class="row display-tr">
                    <div class="display-td">
                        <br>
                        <div class="panel-body">
                            <form action="{{ url('/checkout/withdraw') }}" method="post" id="withdrawal-form">
                                <div class="row">
                                    <div class="col-xs-5 col-xs-offset-1">
                                        <div class="form-group">
                                            <label for="name">User name</label>
                                            <input type="text" id="name" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="form-group">
                                            <label for="refill">Money $</label>
                                            <input type="text" id="refill" class="form-control" name="refill" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-xs-offset-1">
                                        <div class="form-group">
                                            <label for="service">Select service</label>
                                            <select id="service" name="service" class="form-control" required>
                                                <option value="webmoney">Webmoney</option>
                                                <option value="visa">Credit card(Visa/Mastercard)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-xs-offset-1">
                                        <div class="form-group">
                                            <label for="card-name">Card Holder Name and Surname</label>
                                            <input type="text" name="card-name" id="card-name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-xs-offset-1">
                                        <div class="form-group">
                                            <label for="card-number">Card Number</label>
                                            <input type="text" name="card-number" id="card-number" class="form-control" required>
                                        </div>
                                    </div>
                                    {{csrf_field()}}
                                    <div class="col-xs-5 col-xs-offset-1">
                                        <button type="submit" class="btn btn-success">Pay now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection