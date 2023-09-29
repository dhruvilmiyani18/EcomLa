<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Exception\CardException;
use App\Models\ProductBooking;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{
    public function stripePost(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            Charge::create([
                "amount" => $request->amounth * 100, // Amount in cents
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
            ]);

        $cart_id = $request->input('cart_id');
        // dd($cart_id);

        $data = array();
        if($cart_id){
            foreach ($cart_id as $key => $id) {
                $data[$key]['payment_status'] = 'paid';
                $p = Cart::where('id', $id)->first()->product_id;
                ProductBooking::where('product_id', $p)->update($data[$key]);
                Cart::destroy('id', $id);   
            }
            // dd($data);
            return redirect()->route('delivery')->with('success', 'Payment successful!');
            
        }
            Session::flash('success', 'Payment successful');

        } catch (CardException $e) {
            Session::flash('error', $e->getMessage());
        } catch (\Exception $e) {
            Session::flash('error', 'An error occurred while processing your payment.');
        }
    return back();
    }
}
