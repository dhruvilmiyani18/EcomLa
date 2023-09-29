<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductBooking;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\UserContact;

use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

use function PHPUnit\Framework\isNull;

class BaseController extends Controller
{

    public function home()
    {
        $products = Product::get();
        $newProducts = Product::limit(6)->latest()->get();

        $category_data = Category::whereNull('category_id')->get();
        $subCategory_all_data = Category::whereNotNull('category_id')->get();

        // cart data count
        $carts = [];
        if (Auth::User()) {
            $user_id = Auth::User()->id;
            $carts = Cart::where('user_id', $user_id)->get();
            // dd($carts);
            if ($carts->count() > 0) {
                $cart_data_count = $carts->count();
            }
            else{
                $cart_data_count = 0;
            } 
        }
        else{
            $cart_data_count = 0;
        } 
  
        // dd($cart_data_count);

        $data = compact('products', 'newProducts','cart_data_count' ,'category_data', 'subCategory_all_data',);
        return view('front.home')->with($data);
    }

    public function delivery()
    {
        //oder status
        $oder_details = [];
        if (Auth::User()) {
            $oder_details = ProductBooking::where('user_id', Auth::User()->id)->with('product')->get();
        }

        //cart data count
        $carts = [];
        if (Auth::User()) {
            $user_id = Auth::User()->id;
            $carts = Cart::where('user_id', $user_id)->get();
            if ($carts->count() != 0) {
                $cart_data_count = $carts->count();
            } else {
                $cart_data_count = 0;
            }
        } else {
            $cart_data_count = 0;
        }
        //sidebar data
        $category_data = Category::whereNull('category_id')->get();
        $subCategory_all_data = Category::whereNotNull('category_id')->get();
        $data = compact('cart_data_count', 'category_data', 'subCategory_all_data', 'oder_details');
        return view('front.delivery')->with($data);
    }

    public function oder_cancle(Request $request)
    {
        $id = $request->id;

        ProductBooking::where('id', $id)->delete();
        return redirect()->route('delivery')->with('oderstatus', 'It seems like you want to confirm that your order has been successfully canceled and that your payment will be refunded within 7 days.');
    }

    public function product_summary(Request $request, $id)
    {
        // echo $id;

        $products = Product::where('category_id', $id)->get();
        $category = Category::where('id', $id)->first();
        // dd($category);
        //cart data count
        $carts = [];
        if (Auth::User()) {
            $user_id = Auth::User()->id;
            $carts = Cart::where('user_id', $user_id)->get();
            if ($carts->count() != 0) {
                $cart_data_count = $carts->count();
            } else {
                $cart_data_count = 0;
            }
        } else {
            $cart_data_count = 0;
        }
        //sidebar data 
        $category_data = Category::whereNull('category_id')->get();
        $subCategory_all_data = Category::whereNotNull('category_id')->get();

        $data = compact('category_data', 'subCategory_all_data', 'products', 'category', 'cart_data_count');
        return view('front.product_summary')->with($data);
    }

    public function contact()
    {
        //cart data count
        $carts = [];
        if (Auth::User()) {
            $user_id = Auth::User()->id;
            $carts = Cart::where('user_id', $user_id)->get();
            if ($carts->count() != 0) {
                $cart_data_count = $carts->count();
            } else {
                $cart_data_count = 0;
            }
        } else {
            $cart_data_count = 0;
        }
        $data = compact('cart_data_count');
        return view('front.contact')->with($data);
    }

    public function cart(Request $request)
    {
        $quantityPlus = $request->input('quantityplus');
        $quantityMinus = $request->input('quantityminus');
        $qID = $request->input('qId');
        if ($quantityPlus && $qID) {
            $data = Cart::where('id', $qID)->update(['quantity' => $quantityPlus]);
            return redirect()->back()->with('quantityUpdated', 'Quantity Updated Successfully');
        }
        if ($quantityMinus && $qID) {
            $data = Cart::where('id', $qID)->update(['quantity' => $quantityMinus]);
            return redirect()->back()->with('quantityUpdated', 'Quantity Updated Successfully');
        }

        //cart data count
        $carts = [];
        if (Auth::User()) {
            $user_id = Auth::User()->id;
            $carts = Cart::where('user_id', $user_id)->get();
            if ($carts->count() != 0) {
                $cart_data_count = $carts->count();
            } else {
                $cart_data_count = 0;
            }
        } else {
            $cart_data_count = 0;
        }

        //sidebar data 
        $category_data = Category::whereNull('category_id')->get();
        $subCategory_all_data = Category::whereNotNull('category_id')->get();

        $data = compact('carts', 'cart_data_count', 'category_data', 'subCategory_all_data');
        return view('front.cart')->with($data);
    }

    public function product_view(Request $request)
    {
        $id = $request->id;
        $product_detail = Product::where('id', $id)->with('product_details')->first();
        $x = $product_detail->id;
        // dd($x);
        $extra_images = json_decode($product_detail->product_details->image);
        //find related product
        $category_id = $product_detail->category_id;
        $related_product = Product::where('category_id', $category_id)->with('product_details')->get();
        //cart data count
        $carts = [];
        if (Auth::User()) {
            $user_id = Auth::User()->id;
            $carts = Cart::where('user_id', $user_id)->get();
            if ($carts->count() != 0) {
                $cart_data_count = $carts->count();
            } else {
                $cart_data_count = 0;
            }
        } else {
            $cart_data_count = 0;
        }
        //sidebar data
        $category_data = Category::whereNull('category_id')->get();
        $subCategory_all_data = Category::whereNotNull('category_id')->get();

        $data = compact('product_detail', 'extra_images', 'related_product', 'cart_data_count', 'category_data', 'subCategory_all_data',);
        return view('front.product_view')->with($data);
    }

    public function user_login()
    {
        //cart data count
        $carts = [];
        if (Auth::User()) {
            $user_id = Auth::User()->id;
            $carts = Cart::where('user_id', $user_id)->get();
            if ($carts->count() != 0) {
                $cart_data_count = $carts->count();
            } else {
                $cart_data_count = 0;
            }
        } else {
            $cart_data_count = 0;
        }
        //sidebar data
        $category_data = Category::whereNull('category_id')->get();
        $subCategory_all_data = Category::whereNotNull('category_id')->get();
        $data = compact('cart_data_count', 'category_data', 'subCategory_all_data');
        return view('front.login')->with($data);
    }
    public function insert_login(Request $request)
    {
        $data = array(
            'email' => $request->email,
            'password' => $request->password,
            'role'=>'user'
        );
        if (Auth::attempt($data)) {
            return redirect('/');
        } else {
            return redirect()->back()->with('status', 'Invalide Email Or Password !!');
        }
    }

    public function user_register()
    {
        //cart data count
        $carts = [];
        if (Auth::User()) {
            $user_id = Auth::User()->id;
            $carts = Cart::where('user_id', $user_id)->get();
            if ($carts->count() != 0) {
                $cart_data_count = $carts->count();
            } else {
                $cart_data_count = 0;
            }
        } else {
            $cart_data_count = 0;
        }
        //sidebar data
        $category_data = Category::whereNull('category_id')->get();
        $subCategory_all_data = Category::whereNotNull('category_id')->get();
        $data = compact('cart_data_count', 'category_data', 'subCategory_all_data');
        return view('front.register')->with($data);
    }

    public function insert_register(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'Lname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $data = array(
            'name' => $request->fname . ' ' . $request->lname,
            'email' => $request->email,
            'password' => FacadesHash::make($request->password),
            'role' => 'user'
        );

        User::create($data);
        return redirect()->back()->with('status', 'Registration Successfully');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function contact_message(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $data = new UserContact;
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->subject = $request['subject'];
        $data->message = $request['message'];

        $data->save();
        return redirect()->back()->with('status', 'Message Send Successfully');
    }
}
