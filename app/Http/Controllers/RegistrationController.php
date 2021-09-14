<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegistrationController extends Controller
{
    // RIDER REGISTRATION
    public function registration()
    {
        return view('rider.registration');
    }

    public function riderregister(Request $req)
    {
        return User::create([
            'name' => $req['name'], 
            'email' => $req['email'],
            'phone' =>  '+63'."".$req['phone'],
            'password' => Hash::make($req['password']),
            'account_type' =>'2',
        ]);
    }
    //END OF RIDER REGISTRATION


    // CUSTOMER REGISTRATION
    public function registers()
    {
        return view('customer.registers');
    }

    public function registercustomer(Request $req)
    {
        return User::create([
            'name' => $req['name'], 
            'email' => $req['email'],
            'phone' =>  '+63'."".$req['phone'],
            'password' => Hash::make($req['password']),
            'account_type' =>'3',
        ]);
    }
    //END OF CUSTOMER REGISTRATION

}
