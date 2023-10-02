<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($data)) {
            return response(['error_message' => 'Incorrect Details. Please try again']);
        }
        // Authentication passed
        $user = Auth::user();
        $token = $user->createToken("authToken")->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
