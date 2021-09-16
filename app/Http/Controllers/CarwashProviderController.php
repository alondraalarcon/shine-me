<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CarwashProviderController extends Controller
{
    public function index(){
        return view('rider.dashboard');
    }

    // Display CarwashProvider List
    public function carwashproviderlist(){
        $approved = User::all()->where('account_type','2')
                ->where('approved','1');

        $request = User::all()->where('account_type','2')
        ->where('approved','0');

        return view('admin.carwashproviders.riderlist',compact('approved','request'));
    }
    // End of Display CarwashProvider 


    // Show Modal Approving Carwash
    public function show($id)
    {
        $getphone = User::where('id', '=', $id)->first();
        $phone = substr($getphone->phone, 3);   

        $carwashProvider = User::find($id);
        return response()->json(['datas' => $carwashProvider, 'phone' => $phone]);
    }

    public function approved($id)
    {
        $approved = User::where('id', $id)
                    ->update(['approved' => "1"]);

        if($approved) {
            return redirect()->back()->with('success', 'Carwash provider approved successfully!');
       }
    }
    // End of Show Modal Approving Carwash


    // Update Carwash
    public function update(Request $request, $id)
    {
        $checkemail = User::where('email', '=', $request->email)->where('id', '!=' , $id)->first();

            if($checkemail == null){
                $checkphone = User::where('phone', '=', '+63'.$request->phone)->where('id', '!=' , $id)->first();

                if($checkphone == null){

                    $update = User::where('id', $id)
                            ->update([
                                'name' => $request->name,
                                'phone' => '+63'.$request->phone,
                                'email' => $request->email,
                                'address' => $request->address,
                            ]);
    
                    if($update) {
                        return redirect()->back()->with('success', 'Carwash provider updated successfully!');
                    }
                }else{
                    return redirect()->back()->with('error', 'Phone number must be unique!');
                }
            }else{
                return redirect()->back()->with('error', 'Email must be unique!');
            }
    }
    // End of Update Carwash
}
