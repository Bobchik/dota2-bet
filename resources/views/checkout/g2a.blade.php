@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h1 class="text-center">G2A checkout</h1>
            <img class="img-responsive col-xs-offset-4" src="{{'/2303.png'}}" width="150px">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table">
                    <h3 class="panel-title display-td text-center">Payment Details</h3>
                </div>
                <div class="row display-tr">
                    <div class="display-td">
                        <br>
                        <div class="panel-body">
                            <form action="{{ url('checkout/g2a') }}" method="post" id="g2a-checkout-form">
                                    {{--<div class="row">--}}
                                    {{--<div class="col-xs-5 col-xs-offset-1">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="name">First name</label>--}}
                                            {{--<input type="text" id="name" class="form-control" name="name" required>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-5">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="last_name">Last name</label>--}}
                                            {{--<input type="text" id="last_name" class="form-control" name="last_name" required>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-5 col-xs-offset-1">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="refill">Money $</label>--}}
                                            {{--<input type="text" id="refill" class="form-control" name="refill" required>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-10 col-xs-offset-1">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="card-name">Card Holder Name</label>--}}
                                            {{--<input type="text" id="card-name" class="form-control" required>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-10 col-xs-offset-1">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="card-number">Card Number</label>--}}
                                            {{--<input type="text" id="card-number" class="form-control" required>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-5 col-xs-offset-1">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="card-expiry-month">Expiration Month</label>--}}
                                            {{--<input type="text" id="card-expiry-month" class="form-control" required>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-5">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="card-expiry-year">Expiration Year</label>--}}
                                            {{--<input type="text" id="card-expiry-year" class="form-control" required>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-10 col-xs-offset-1">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="card-cvc">CVC</label>--}}
                                            {{--<input type="text" id="card-cvc" class="form-control" required>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{csrf_field()}}
                                    <div class="col-xs-5 col-xs-offset-1">
                                        <button type="submit" class="btn btn-success" id="button">Pay now</button>
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