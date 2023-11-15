<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //show only the data that matches user_id with auth_id
        $data = Temperature::where('user_id', auth()->user()->id)->get();
        return response()->json($data);
    }
}
