<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\Temperature;
use Illuminate\Http\Request;


class HospitalController extends Controller
{
    public function addDocs(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'designation' => 'required|string',
            'hospital_name' => 'required|string',
            'email' => 'required|string',
        ]);
        $data = Doctors::create(
            [
                'hospital_id' => auth()->user()->id,
                'name' => $fields['name'],
                'designation' => $fields['designation'],
                'hospital_name' => $fields['hospital_name'],
                'email' => $fields['email'],
            ]
        );
        return $data;
    }


}
