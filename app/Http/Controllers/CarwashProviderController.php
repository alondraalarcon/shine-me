<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CarwashProviderController extends Controller
{
    // Display CarwashProvider List
    public function carwashproviderlist(){
        $approved = User::all()->where('account_type','2')
                ->where('approved','1');

        $request = User::all()->where('account_type','2')
        ->where('approved','0');

        return view('admin.riderlist',compact('approved','request'));
    }
    // End of Display CarwashProvider 
}
