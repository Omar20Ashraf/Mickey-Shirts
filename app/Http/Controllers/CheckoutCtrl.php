<?php

namespace App\Http\Controllers;

use App\order;
use Cartalyst\Stripe\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
class CheckoutCtrl extends Controller
{

    public function shipping()
    {
    	return view('front.shipping-info');
    }

    //Pay With Stripe
    public function payment()
    {
        return view('front.payment');
    }

    public function store(Request $request){
      try {
         $stripe = Stripe::make('sk_test_LeleRLuM2G48ngSua2eMoXdP');
         $token = $_POST['stripeToken'];
         $charge = $stripe->charges()->create([
             'amount'   => Cart::total(),
             'currency' => 'USD',
             'source' => $request->stripeToken,
             'description' =>'order',
             'receipt_email' => $request->email,
             'metadata' => [
                  // 'contents' => $contents,
                  'quantity' => Cart::count(),
                  // 'discount' => collect(session()->get('coupon'))->toJson(),
              ],

         ]);

         //Create The Order Table
          order::createOrder();

         //empty the card after payment
         Cart::destroy();
         //success
         return redirect()->route('front')->with('success', 'Thank you! Your payment has been successfully accepted!');
      
      } catch (CardErrorException $e) {
          return back()->withErrors('Error! ' . $e->getMessage());
      }
    }

   // pay With Paypal
    public function payWithPaypal()
    {
      $provider = new ExpressCheckout;

      $invoiceId = uniqid();

      $data = $this->cartDate($invoiceId);

      $response = $provider->setExpressCheckout($data);

       // This will redirect user to PayPal
      return redirect($response['paypal_link']);
    }


    public function paypalSuccess(Request $request)
    {
      $provider = new ExpressCheckout;

      $token = $request->token;
      
      $PayerID = $request->PayerID;

      $response = $provider->getExpressCheckoutDetails($token);

      $invoiceId = $response['INVNUM']??uniqid();
      // $invoiceId = uniqid();
      
      $date = $this->cartDate($invoiceId);

      $response = $provider->doExpressCheckoutPayment($data, $token, $PayerID);

      dd($response);

      Order::createOrder();

      return 'Order Completed';
    }

    protected function cartDate($invoiceId)
    {
      $data = [];
      $data['items'] = [];

      foreach (Cart::content() as $key => $cart) {
        $itemDetail = [
          'name' => $cart->name,
          'price' => $cart->price,
          'qty' => $cart->qty
        ];
        $data['items'][] = $itemDetail;
      }

      $data['invoice_id'] = $invoiceId;
      $data['invoice_description'] = "test Invoice";
      $data['return_url'] = route('checkout.paypal-success');
      $data['cancel_url'] = url('/test');

      $total = 0;
      foreach($data['items'] as $item) {
          $total += $item['price']*$item['qty'];
      }

      $data['total'] = $total;

      return $data;
    }
  }