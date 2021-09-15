<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
  
    // CUSTOMER REGISTRATION
    public function registers()
    {
        return view('customer.registers');
    }

    public function registercustomer(Request $req)
    {
        $newcustomer = new User;

        $newcustomer->name = $req->name;
        $newcustomer->email = $req->email;
        $newcustomer->phone ='+63'.$req->phone;
        $newcustomer->password = Hash::make($req->password);
        $newcustomer->account_type = '3';

        $insert = $newcustomer->save();

        if($insert){
            Session::flash('message', 'New Customer Added!'); 
            Session::flash('alert-class', 'alert-danger'); 
        }

    }
    //END OF CUSTOMER REGISTRATION

}
