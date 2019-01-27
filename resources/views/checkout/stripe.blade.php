@extends('layouts.app')
@include('common.menu')

@section('content')
    <div class="row" style="margin-top: 60px;">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h1 class="text-center" style="color: white;">Stripe checkout</h1>
            {{--<img class="img-responsive col-xs-offset-4" src="{{'/images.png'}}" width="150px">--}}
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table">
                    <div class="row display-tr">
                        <h4 class="panel-title display-td text-center">Payment Details</h4>
                    </div>
                </div>
                <div class="row display-tr">
                    <div class="display-td">
                        <br>
                        <div class="panel-body">
                            <form action="{{ url('checkout/stripe') }}" method="post" id="stripe-checkout-form">
                                <div class="row">
                                    <div class="col-xs-5 col-xs-offset-1">
                                        <div class="form-group">
                                            <label for="name">User name</label>
                                            <input type="text" id="name" class="form-control stripe-input" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="form-group">
                                            <label for="refill">Money $</label>
                                            <input type="text" id="refill" class="form-control stripe-input" name="refill" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-xs-offset-1">
                                        <div class="form-group">
                                            <label for="card-name">Card Holder Name</label>
                                            <input type="text" id="card-name" class="form-control stripe-input" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-xs-offset-1">
                                        <div class="form-group">
                                            <label for="card-number">Card Number</label>
                                            <input type="text" id="card-number" class="form-control stripe-input" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-xs-offset-1">
                                        <div class="form-group">
                                            <label for="card-expiry-month">Expiration Month</label>
                                            <input type="text" id="card-expiry-month" class="form-control stripe-input" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="form-group">
                                            <label for="card-expiry-year">Expiration Year</label>
                                            <input type="text" id="card-expiry-year" class="form-control stripe-input" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-10 col-xs-offset-1">
                                        <div class="form-group">
                                            <label for="card-cvc">CVC</label>
                                            <input type="text" id="card-cvc" class="form-control stripe-input" required>
                                        </div>
                                    </div>
                                    {{csrf_field()}}
                                    <div class="col-xs-5">
                                        <input style="width: 100px; margin-left: 35px; padding: 0; text-align: center;" class="balance-btn" id="button" type="submit" value="Pay now">
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