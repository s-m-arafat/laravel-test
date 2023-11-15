<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class logoutController extends Controller
{
    public function logout(Request $req) {
        $req->user()->tokens()->delete();

        return response()->json(['message' => "Logged out"], 200);
    }
}
