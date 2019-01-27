<?php

namespace App\Http\Controllers;

use App\Withdraw;
use Auth;
use League\Flysystem\Exception;
use Stripe\Charge;
use Stripe\Stripe;
use G2APay\G2APay;

class CheckoutController extends Controller
{
    public function getG2A()
    {
        return view('checkout.g2a');
    }

    public function postG2A()
    {
        $hash = '67f1a203-5daf-491b-8d54-6c2f28ec8d37'; // Get it from G2APay
        $secret = 'k%VZ~NvG9iU%5tyCc@hsQQqnjIoI!9hd500^OvDXRhTWPEi_9ChZdMAAdxSX@&&*'; // Get it from G2APay
        $email = 'workspace1936@gmail.com'; // Your G2APay store email
        $success = 'http://gameproject.app'; // URL for successful callback;
        $fail = 'http://gameproject.app'; // URL for failed callback;
        $order = random_int(1000, 9999); // Choose your order id or invoice number, can be anything


        $currency = 'USD'; // Pass currency, if no given will use "USD"


        $payment = new G2APay($hash, $secret, $email, $success, $fail, $order, $currency);

        // Set item parameters
        $sku = 1; // Item number (In most cases $sku can be same as $id)
        $name = 'My Game';
        $quantity = 1; // Must be integer
        $id = 1; // Your items' identifier
        $price = 9.95; // Must be float
        $url = 'http://gameproject.app/profile';

        $extra = '';
        $type = '';

        // Add item to payment
        $payment->addItem($sku, $name, $quantity, $id, $price, $url, $extra, $type);

//        $orderId = 1; // Generate or save in your database
        $extras = [];

        $response = $payment->test()->create($extras);

    }

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
