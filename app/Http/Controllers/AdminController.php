<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Refregion;
use App\Models\Refbrgy;
use App\Models\Refcitymun;
use App\Models\Refprovince;
use App\Models\rider_info;
use App\Models\WalletTransaction;

use DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    // Display CarwashProvider List
    public function carwashproviderlist(){
        $approved = DB::table('users')
            ->leftJoin('refregions','refregions.regCode','=','users.region')
            ->leftJoin('refprovinces','refprovinces.provCode','=','users.province')
            ->leftJoin('refcitymuns','refcitymuns.citymunCode','=','users.municipal')
            ->leftJoin('refbrgies','refbrgies.brgyCode','=','users.brgy')
            ->select('users.*','refregions.regDesc','refprovinces.provDesc','refcitymuns.citymunDesc','refbrgies.brgyDesc')
            ->where('account_type','2')->where('approved','1')->get();

        $request = DB::table('users')
            ->leftJoin('refregions','refregions.regCode','=','users.region')
            ->leftJoin('refprovinces','refprovinces.provCode','=','users.province')
            ->leftJoin('refcitymuns','refcitymuns.citymunCode','=','users.municipal')
            ->leftJoin('refbrgies','refbrgies.brgyCode','=','users.brgy')
            ->select('users.*','refregions.regDesc','refprovinces.provDesc','refcitymuns.citymunDesc','refbrgies.brgyDesc')
            ->where('account_type','2')->where('approved','0')->get();

        $region = Refregion::all();
        $brgy = Refbrgy::all();
        $municipal = Refcitymun::all();
        $province = Refprovince::all();

        return view('admin.carwashproviders.riderlist',compact('approved','request','region','province','municipal','brgy'));
    }
    // End of Display CarwashProvider 

    public function customerslist()
    {
        $customers = DB::table('users')
            ->leftJoin('refregions','refregions.regCode','=','users.region')
            ->leftJoin('refprovinces','refprovinces.provCode','=','users.province')
            ->leftJoin('refcitymuns','refcitymuns.citymunCode','=','users.municipal')
            ->leftJoin('refbrgies','refbrgies.brgyCode','=','users.brgy')
            ->select('users.*','refregions.regDesc','refprovinces.provDesc','refcitymuns.citymunDesc','refbrgies.brgyDesc')
            ->where('account_type','3')->get();

            return view('admin.customers.customers',compact('customers'));

    }
    // Show Modal Approving Carwash
    public function show($id)
    {
        $getphone = User::where('id', '=', $id)->first();
        $phone = substr($getphone->phone, 3);   

        $carwashProvider = DB::table('users')
            ->leftJoin('refregions','refregions.regCode','=','users.region')
            ->leftJoin('refprovinces','refprovinces.provCode','=','users.province')
            ->leftJoin('refcitymuns','refcitymuns.citymunCode','=','users.municipal')
            ->leftJoin('refbrgies','refbrgies.brgyCode','=','users.brgy')
            ->select('users.*','refregions.regDesc','refprovinces.provDesc','refcitymuns.citymunDesc','refbrgies.brgyDesc')
            ->where('users.id',$id)->first();

        return response()->json(['datas' => $carwashProvider, 'phone' => $phone]);
    }


    public function uploadimage(Request $request,$id)
    {
        if($request->file('file')) {
      
            $file = $request->file('file');
            $filename = $id;

            // File extension
            $extension = $file->getClientOriginalExtension();
            
            // File upload location
            $location = 'r_image';

            // Upload file
            $finalname =$filename.".".$extension;

            $file->move($location,$finalname);
            
            // File path
            $filepath = url('r_image/'.$filename);

            return response()->json(['message' => 'Rider Profile Image Uploaded.', 'code' => 1, 'image' => $finalname]);
            
        }else{
            // Response
            return response()->json(['message' => 'Rider Profile not Uploaded.', 'code' => 0]);
        }
          
    }

    public function approved(Request $req, $id)
    {
        $checkingOR = rider_info::where('or','=',$req->motor_or)->first();
        $checkingCR = rider_info::where('cr','=',$req->motor_cr)->first();
        $checkingDLicense = rider_info::where('license_no','=',$req->motor_license)->first();

        if($checkingOR == null)
        {
            if($checkingCR == null )
            {
                if($checkingDLicense == null){

                    $riderInfo = new rider_info;

                    $riderInfo->rider_id = $id;
                    $riderInfo->motor_brand = $req->motor_brand;
                    $riderInfo->motor_model = $req->motor_model;
                    $riderInfo->motor_year = $req->motor_year;
                    $riderInfo->or = $req->motor_or;
                    $riderInfo->cr = $req->motor_cr;
                    $riderInfo->license_no = $req->motor_license;

                    if($riderInfo->save()) {
                        $wallet = new WalletTransaction;
                        
                        $wallet->user_id = $id;
                        $wallet->save();
                        
                        User::where('id', $id)->update(['approved' => "1",'image' => $req->image_name]);
                        return response()->json(['message' => 'You are now approved, Enjoy cleaning!', 'code' => 1]);
                    }

                }else{
                    return response()->json(['message' => 'Driver License number must be unique!', 'code' => 0]);
                }
            }else{
                return response()->json(['message' => 'CR number must be unique!', 'code' => 0]);
            }
        }else{
            return response()->json(['message' => 'OR number must be unique!', 'code' => 0]);
        }
    }


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
                                'region' => $request->region,
                                'province' => $request->province,
                                'municipal' => $request->municipal,
                                'brgy' => $request->brgy,
                                'street_add' => $request->street,
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