<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function registration()
    {
        return view('rider.registration');
    }

    public function riderregister(Request $req)
    {
        return User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'phone' => $req['phone'],
            'password' => Hash::make($req['password']),
            'account_type' =>'2',
        ]);
    }
}
