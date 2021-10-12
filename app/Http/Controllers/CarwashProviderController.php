<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Refregion;
use App\Models\Currentadd;
use DB;

class CarwashProviderController extends Controller
{
    public function index(){
        $userinfo = DB::table('users')
            ->leftJoin('refregions','refregions.regCode','=','users.region')
            ->leftJoin('refprovinces','refprovinces.provCode','=','users.province')
            ->leftJoin('refcitymun','refcitymun.citymunCode','=','users.municipal')
            ->leftJoin('refbrgy','refbrgy.brgyCode','=','users.brgy')
            ->select('users.*','refregions.regDesc','refprovinces.provDesc','refcitymun.citymunDesc','refbrgy.brgyDesc')
            ->where('users.id', auth()->user()->id)->first();

        $userinfocurrent = DB::table('currentadds')
            ->leftJoin('refregions','refregions.regCode','=','currentadds.region')
            ->leftJoin('refprovinces','refprovinces.provCode','=','currentadds.province')
            ->leftJoin('refcitymun','refcitymun.citymunCode','=','currentadds.municipal')
            ->leftJoin('refbrgy','refbrgy.brgyCode','=','currentadds.brgy')
            ->select('currentadds.*','refregions.regDesc','refprovinces.provDesc','refcitymun.citymunDesc','refbrgy.brgyDesc')
            ->where('currentadds.user_id', auth()->user()->id)->first();

        $region = Refregion::all();

        return view('rider.dashboard',compact('userinfo','region','userinfocurrent'));
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
    
    // SWITCHING ON ONLINE RIDER
    public function onchangeStatRider(Request $req)
    {
        if($req->addressval == 2){
            if($req->value == 'true'){

                $newcurrentadd = new Currentadd;

                $newcurrentadd->user_id = auth()->user()->id;
                $newcurrentadd->region = $req->current_region;
                $newcurrentadd->province = $req->current_province;
                $newcurrentadd->municipal = $req->current_municipal;
                $newcurrentadd->brgy = $req->current_brgy;
                $newcurrentadd->street = $req->current_street;
                $newcurrentadd->active = '1';

                $insert = $newcurrentadd->save();

                if($insert){
                    $update = User::where('id', auth()->user()->id)
                            ->update(['active' => "1", 'addresstype' => "2"]);

                    return response()->json(['message' => 'You are now online, Enjoy cleaning!', 'code' => 1]); 
                }
            }else{
                $update = User::where('id', auth()->user()->id)
                        ->update(['active' => "0", 'addresstype' => "0"]);

                Currentadd::where('user_id', auth()->user()->id)->delete();

                return response()->json(['message' => 'You are now offline, See you tomorrow', 'code' => 1]); 
            }        
        }elseif($req->addressval == 1){
            if($req->value == 'true'){
                $update = User::where('id', auth()->user()->id)
                        ->update(['active' => "1", 'addresstype' => "1"]);

                return response()->json(['message' => 'You are now online, Enjoy cleaning!', 'code' => 1]); 
            }else{
                $update = User::where('id', auth()->user()->id)
                        ->update(['active' => "0", 'addresstype' => "0"]);
    
                return response()->json(['message' => 'You are now offline, See you tomorrow', 'code' => 1]); 
            }
        }else{
            return response()->json(['message' => 'Please select address first.', 'code' => 0]); 
        }

      
    }
    // END SWITCHING ON ONLINE RIDER
}
