<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Refregion;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use DB;

class RegistrationController extends Controller
{
  
    // CARWASH PROVIDER REGISTRATION
    public function registers()
    {
        $region = Refregion::all();
        return view('rider.registration',compact('region'));
    }

    public function forprovince($regCode)
    {
        $province = DB::table("refprovinces")
                    ->where("regCode",$regCode)->orderBy("provDesc")
                    ->get();

        return json_encode($province);
    }

    public function formunicipal($provinceCode)
    {
        $municipal = DB::table("refcitymun")
                    ->where("provCode",$provinceCode)->orderBy("citymunDesc")
                    ->get();

        return json_encode($municipal);
    }

    public function forbrgy($municipalityCode)
    {
        $brgy = DB::table("refbrgy")
                    ->where("citymunCode",$municipalityCode)->orderBy("brgyDesc")
                    ->get();

        return json_encode($brgy);
    }

    public function riderapplication(Request $req)
    {
        $checkemail = User::where('email','=',$req->email)->first();
        $checkphone= User::where('phone','=',$req->phone)->first();

        if($checkemail){
            return redirect()->back()->with('error', 'Email must be unique');
        }elseif($checkphone){
            return redirect()->back()->with('error', 'Phone number must be unique');
        }else{
            $newcustomer = new User;

            $newcustomer->name = $req->name;
            $newcustomer->email = $req->email;
            $newcustomer->phone ='+63'.$req->phone;
            $newcustomer->password = Hash::make($req->password);
            $newcustomer->account_type = '2';
            $newcustomer->region = $req->region;
            $newcustomer->province = $req->province;
            $newcustomer->municipal = $req->municipal;
            $newcustomer->brgy = $req->brgy;
            $newcustomer->street_add = $req->street;

            $insert = $newcustomer->save();

            if($insert){
                return view('rider.applicationnotice');        
            }
        }

    }
    //END OF CARWASH PROVIDER REGISTRATION

}
