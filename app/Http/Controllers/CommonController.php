<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temperature;

class CommonController extends Controller
{
    public function addTemp(Request $request)
    {
        $fields = $request->validate([
            'temperature' => 'required|string',
        ]);
        $creds = [
            'temperature' => $fields['temperature'],
            'user_id' => auth()->user()->id,
        ];
        $data = Temperature::create($creds);
        return $data;
    }
}
