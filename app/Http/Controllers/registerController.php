<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\HospitalOwner;
use Illuminate\Http\Request;
use App\Models\User;

class registerController extends Controller
{
    public function register(Request $request)
    {
        // for checking role base acc creation
        $role = $request->role;
        $account = null;

        if ($role == 'hospitalowner') {
            $fields = $request->validate([
                'name_of_hospital' => 'required|string',
                'phone' => 'required|int',
                'age' => 'required|int',
                'gender' => ['required', 'in:male,female'],
                'address' => 'required|string',
                'email' => 'required|string|unique:user',
                'password' => 'required|string'
            ]);

            // First create a user account for user id
            User::create([
                'name' => $fields['name_of_hospital'],
                'role' => 'hospital_owner',
                'age' => $fields['age'],
                'gender' => $fields['gender'],
                'phone' => $fields['phone'],
                'email' => $fields['email'],
                'password' => bcrypt($fields['password']),
            ]);

            // insert the user id to hospital owner table
            $userID = User::where('email', $fields['email'])->first()->id;
            // $account for return creds
            $account = HospitalOwner::create([
                'name_of_hospital' => $fields['name_of_hospital'],
                'user_id' => $userID,
                'phone' => $fields['phone'],
                'address' => $fields['address'],
                'email' => $fields['email'],
                'password' => bcrypt($fields['password'])
            ]);
        }



        // user account creation
        else if ($role == 'user') {
            $fields = $request->validate([
                'name' => 'required|string',
                'age' => 'required|int',
                'gender' => ['required', 'in:male,female'],
                'phone' => 'required|int',
                'email' => 'required|string|unique:user',
                'password' => 'required|string'
            ]);

            $account = User::create([
                'name' => $fields['name'],
                'age' => $fields['age'],
                'gender' => $fields['gender'],
                'phone' => $fields['phone'],
                'email' => $fields['email'],
                'password' => bcrypt($fields['password'])
            ]);
        } else {
            return response()->json(['message' => 'Account creation failed. Check your information'], 401);
        }

        $token = $account->createToken('user')->plainTextToken;

        $response = [
            'Creds' => $account,
            'token' => $token
        ];

        return response($response, 201);
    }
}
