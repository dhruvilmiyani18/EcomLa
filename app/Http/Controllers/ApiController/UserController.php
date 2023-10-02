<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {

        // $token = $user->createToken('Token Name')->accessToken;
        // return response()->json(['token' => $token], 200);
    }
}
