@extends('layouts.app')
@include('common.menu')

@section('content')
    <div class="row" style="margin-top: 60px;">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h1 class="text-center">Webmoney checkout</h1>
            {{--<img class="img-responsive col-xs-offset-4" src="{{'/04.jpg'}}" width="150px">--}}
            <br>
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table">
                    <div class="row display-tr">
                        <h4 class="panel-title display-td text-center">Pay with service Web Merchant Interface</h4>
                    </div>
                </div>
                <div class="row display-tr">
                    <div class="display-td">
                        <br>
                        <div class="panel-body">
                            <form id=pay name=pay method="POST"
                                  action="https://merchant.webmoney.ru/lmi/payment.asp">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-3">
                                        <div class="form-group">
                                            <input style="border: 1px solid black;" class="form-control" type="text" name="LMI_PAYMENT_AMOUNT" value="0"
                                                   required>
                                        </div>
                                    </div>
                                    <input class="form-control" type="hidden" name="LMI_PAYMENT_DESC" value="Buy money in the game">
                                    <input class="form-control" type="hidden" name="LMI_PAYMENT_NO"
                                           value="<?php random_int(1, 99999); ?>">
                                    <input class="form-control" type="hidden" name="LMI_PAYEE_PURSE"
                                           value="Z145179295679">
                                    <input class="form-control" type="hidden" name="LMI_SIM_MODE" value="0">
                                        {{--<div class="col-md-6 col-md-push-3">--}}
                                    <input style="width: 100px; padding: 0px; text-align: center;" class="balance-btn" type="submit" value="Pay now">
                                        {{--</div>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
