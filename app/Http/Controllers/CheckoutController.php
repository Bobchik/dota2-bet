<?php

namespace App\Http\Controllers;

use App\Withdraw;
use Auth;
use League\Flysystem\Exception;
use Stripe\Charge;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function getStripe()
    {
        return view('checkout.stripe', compact('pay'));
    }


    public function postStripe()
    {
        $user_coins = Auth::user()->coins;

        Stripe::setApiKey("sk_test_gsnmhNoQKUSOkQOTH5pAE7yZ");

        try{
            $charge = Charge::create([
                "amount" => request()->input('refill') * 100,
                "currency" => "usd",
                "source" => request()->input('stripeToken'), // obtained with Stripe.js
                "description" => "Test Charge"
            ]);

            if ($charge){
                request()->user()->update([
                    'coins' => $user_coins + request()->input('refill')
                ]);
            }
        }catch (Exception $e){

            return redirect('/profile')->with('error', $e->getMessage());
        }

        return redirect('/profile')->with('success', 'Successfully purchased products!');

    }

    public function getWebMoney()
    {
        return view('checkout.webmoney');
    }

    public function withdraw()
    {
        Withdraw::create(request()->all());

        return back()->with('message', 'Your request in process!');
    }

}
