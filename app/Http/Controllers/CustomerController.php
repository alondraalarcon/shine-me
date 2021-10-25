<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Refregion;
use App\Models\Refprovince;
use App\Models\Refcitymun;
use App\Models\Refbrgy;
use App\Models\Booking;
use App\Models\Currentadd;
use DB;

class CustomerController extends Controller
{
    public function index(){    
        $userinfo = User::where('id',auth()->user()->id);
        $vehicle = Vehicle::where('status','=','1')->orderBy('Type','ASC')->get();
        $region = Refregion::all();
        $province = Refprovince::all();
        $municipal = Refcitymun::all();
        $brgy = Refbrgy::all();
        $riderlist = DB::table('users')
            ->leftJoin('refregions','refregions.regCode','=','users.region')
            ->leftJoin('refprovinces','refprovinces.provCode','=','users.province')
            ->leftJoin('refcitymuns','refcitymuns.citymunCode','=','users.municipal')
            ->leftJoin('refbrgies','refbrgies.brgyCode','=','users.brgy')
            ->select('users.*','refregions.regDesc','refprovinces.provDesc','refcitymuns.citymunDesc','refbrgies.brgyDesc')
            ->where('account_type', '=', '2')->where('active', '=', '1')->get();


        return view('customer.dashboard',compact('vehicle','region','userinfo','province','municipal','brgy','riderlist'));
    }

    public function ridersearch(Request $req)
    {
        $riderlist = User::where('account_type', '=', '2')
                ->where('active', '=', '1')
                ->get();
        return response()->json($riderlist);
    }
    
    public function riderinfofetch(Request $req)
    {
        $riderinfo = DB::table('users')
            ->leftJoin('refregions','refregions.regCode','=','users.region')
            ->leftJoin('refprovinces','refprovinces.provCode','=','users.province')
            ->leftJoin('refcitymuns','refcitymuns.citymunCode','=','users.municipal')
            ->leftJoin('refbrgies','refbrgies.brgyCode','=','users.brgy')
            ->leftJoin('currentadds', 'currentadds.user_id','=','users.id')
            ->select('users.*','refregions.regDesc','refprovinces.provDesc','refcitymuns.citymunDesc',
                    'refbrgies.brgyDesc','currentadds.lat','currentadds.long')
            ->where('users.id', '=', $req->idx)->first();

        $vehicle =  DB::table('vehicles')->where('id', '=', $req->vehicle1)->first();
        
        return response()->json(['rider' => $riderinfo, 'vehicle' => $vehicle]);
    }

    public function riderdistancefetch(Request $req)
    {
        $vehicle =  DB::table('vehicles')->where('id', '=', $req->vehicle1)->first();

        $riders = DB::table('users')
                ->leftJoin('currentadds', 'currentadds.user_id','=','users.id')
                ->select('users.*', 'currentadds.lat','currentadds.long')
                ->where('users.account_type','=','2')
                ->where('users.wallet','>=',$vehicle->price)->get();
        
        $distanceArray =[];
        foreach($riders as $rider){

            $theta = $req->long - $rider->long;
            $dist = sin(deg2rad($req->lat)) * sin(deg2rad($rider->lat)) +  cos(deg2rad($req->lat)) * cos(deg2rad($rider->lat)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $km = $miles * 1.609344;
            
            $distance = ['distance' =>substr($km,0,5), 'id' => $rider->id, 'name' => $rider->name,
                        'phone' => $rider->phone, 'wallet' => $rider->wallet];
            array_push($distanceArray, $distance);
        }
        return response()->json($distanceArray); 
    }

    public function saveBooking(Request $req)
    {
        date_default_timezone_set('Asia/Manila');
        $datetime = date("Y-m-d h:i:s"); 

        $checkifhasbooking = Booking::where('user_id','=',auth()->user()->id)
                            ->where('status','=',0)->first();

        if($checkifhasbooking == null){

            $booking = new Booking;

            $booking->user_id = auth()->user()->id;
            $booking->rider_id = $req->rider_id;
            $booking->vehicle_id = $req->vehicle_id;
            $booking->booking_amount = $req->booking_amount;
            $booking->total_booking_amount = $req->total_amount;
            $booking->status = '0';
            $booking->booking_date_time = $datetime;

            if($booking->save()) {
                $newcurrentadd = new Currentadd;

                $newcurrentadd->user_id = auth()->user()->id;
                $newcurrentadd->lat = $req->lat;
                $newcurrentadd->long = $req->long;
                $newcurrentadd->landmark = $req->landmark;
                $newcurrentadd->active = '1';
    
                $newcurrentadd->save();

                return response()->json(['message' => 'Booked Successfully!', 'code' => 1]); 
            }else{
                return response()->json(['message' => 'Booked not!', 'code' => 1]); 
            }

        }else{
            return response()->json(['error' => 'You have ongoing booking, cant have multiple booking!', 'code' => 1]); 
        }
    }

    public function getBookingCustomer()
    {
        $booking = Booking::where('user_id','=',auth()->user()->id)
        ->where('status','=',1)->first();

        if($booking == null){
            return response()->json('0'); 
        }else{
            return response()->json($booking); 
        }
    }
}
