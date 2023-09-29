<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductBooking;
use Symfony\Component\HttpFoundation\Session\Session;
use Omnipay\Omnipay;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class ProductBookingController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name'=> 'required|min:5', 
            'phone'=> 'required|min:10', 
            'address'=> 'required|min:15', 
        ]);

        $productIds = $request->input('product_ids');
        $amounth = 0;
        $data = array();

        foreach ($productIds as $key => $productid) {
            $cart = Cart::find($productid);
            $product = Product::find($cart->product_id);
            $amounth += $cart->product->price * $cart->quantity;
            $data[$key]['user_id'] = $cart->user_id;
            $data[$key]['product_id'] = $cart->product_id;
            $data[$key]['quantity'] = $cart->quantity;
            $data[$key]['price'] = $product->price;
            $data[$key]['sub_total'] = $product->price * $cart->quantity;
            $data[$key]['name'] = $request->name;
            $data[$key]['address'] = $request->address;
            $data[$key]['phone'] = $request->phone;
            $data[$key]['created_at'] = date('Y-m-d H:i:s');
        }

        $product_booking = ProductBooking::insert($data);

        if (is_object($product_booking) && property_exists($product_booking, 'status') && $product_booking->status == 'accepted') {
            Cart::destroy($productIds);
        }
        $grand_total = $amounth;
        
        $carts = [];
        if (Auth::User()) {
            $user_id = Auth::User()->id;
            $carts = Cart::where('user_id', $user_id)->get();
        }
        // dd($carts);
        $data = compact('grand_total','productIds','carts');
        
        return  view('stripe')->with($data);
    }
}


