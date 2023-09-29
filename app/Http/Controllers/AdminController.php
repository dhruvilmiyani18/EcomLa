<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProductBooking;
use App\Models\Category;
use App\Models\UserContact;

class AdminController extends Controller
{
    public function login()
    {
        // echo Hash::make('123');
        return view('admin.login');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function makelogin(Request $request)
    {
        $data = array(
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin'
        );

        if (Auth::attempt($data)) {
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with(['message' => "Invalide Email Or Password"]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function show_user(Request $request)
    { $search = $request->input('search') ?? '';
        $userdata = User::where('role', 'user')->paginate(1);
        $data = compact('userdata','search');
        return view('admin.show_user')->with($data);
    }

    public function search_user(Request $request){

        $search = $request->input('search') ?? '';
        // dd($search);
        $userdata = User::where('role', 'user')
        ->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%");
        })
        ->paginate(1);
        // dd($userdata);
        $data = compact('userdata', 'search');
        return view('admin.show_user')->with($data);
    }

    public function delete_user(Request $request)
    {
        $id = $request->id;
        $data =  User::find($id);
        $data->delete();
    }
    public function show_oder(Request $request)
    {
        $all_oder = ProductBooking::with('product', 'user')->get();
        $data = compact('all_oder');
        return view('admin.show_oder')->with($data);
    }
    
    public function delete_oder(Request $request)
    {
        $id = $request->id;
        $data =  ProductBooking::where('id', $id)->delete();
        return back()->with(['message' => "Order Deleted"]);
    }
    public function oder_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        ProductBooking::where('id', $id)->update(['status' => $status]);
        return back()->with(['message' => "Order Status Updated"]);
    }
    public function user_message()
    {
        $user_message = UserContact::all();
        $data = compact('user_message');
        return view('admin.user_message')->with($data);
    }
    // search controllers
}
