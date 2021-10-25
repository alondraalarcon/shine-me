<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Refregion;
use App\Models\Currentadd;
use App\Models\Booking;
use App\Models\rider_info;
use App\Models\WalletTransaction;
use DB;

class CarwashProviderController extends Controller
{
    public function index(){
        $userinfo = DB::table('users')
            ->leftJoin('refregions','refregions.regCode','=','users.region')
            ->leftJoin('refprovinces','refprovinces.provCode','=','users.province')
            ->leftJoin('refcitymuns','refcitymuns.citymunCode','=','users.municipal')
            ->leftJoin('refbrgies','refbrgies.brgyCode','=','users.brgy')
            ->select('users.*','refregions.regDesc','refprovinces.provDesc','refcitymuns.citymunDesc','refbrgies.brgyDesc')
            ->where('users.id', auth()->user()->id)->first();
        
        return view('rider.dashboard',compact('userinfo'));
    }

    public function wallet()
    {
        $wallets = DB::table('wallet_transactions')->where('user_id','=',auth()->user()->id)
                ->whereIn('type', array(1,2,3,4))
                ->orderBy('id','desc')->get();

        return view('rider.wallet.wallet',compact('wallets'));
    }

    public function getBooking()
    {
        $booking = Booking::where('rider_id','=',auth()->user()->id)
                    ->where('status','=',0)->first();
        
        if($booking == null){
            return response()->json('0'); 
        }else{
            return response()->json($booking); 
        }
    }

    public function confirmBooking($id)
    {
        $accepted = Booking::where('id', $id)
                    ->update(['status' => "1"]);    
        
        if($accepted) {
            User::where('id', auth()->user()->id)
                    ->update(['active' => "0"]);    

            return response()->json($id); 
        }
    }

    public function booking_data($id)
    {
        $bookinginfo = DB::table('bookings')
                    ->leftJoin('users', 'users.id','=','bookings.user_id')
                    ->leftJoin('vehicles','vehicles.id','=','bookings.vehicle_id')
                    ->leftJoin('currentadds','currentadds.user_id','=','bookings.user_id')
                    ->select('bookings.*', 'users.name as u_name', 'users.phone as u_phone',
                    'vehicles.type as v_type','currentadds.lat as c_lat','currentadds.long as c_long',
                    'currentadds.landmark as c_landmark')
                    ->where('bookings.id','=',$id)->first();

        return view('rider.bookinginfo',compact('bookinginfo'));
    }

    public function doneBooking(Request $req)
    {
        date_default_timezone_set('Asia/Manila');
        $datetime = date("Y-m-d h:i:s");


        $done = Booking::where('id', $req->booking_id)
                ->update(['status' => "2", 'complete_date_time'=>$datetime]);    

        if($done) {
            Currentadd::where('user_id', auth()->user()->id)->delete();
            Currentadd::where('user_id', $req->customer_id)->delete();

            return response()->json(['message' => 'Done Cleaning, Finding another booking...', 'code' => 1]); 
        }
    }

    
    // SWITCHING ON ONLINE RIDER
    public function onchangeStatRider(Request $req)
    {
        if($req->value == 'true'){

            $newcurrentadd = new Currentadd;

            $newcurrentadd->user_id = auth()->user()->id;
            $newcurrentadd->lat = $req->lat;
            $newcurrentadd->long = $req->long;
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
        
    }
    // END SWITCHING ON ONLINE RIDER

    public function topupRequest(Request $request)
    {
        $checkifNOrequest = WalletTransaction::where('type','=','1')->where('amount','!=','0')
                ->where('user_id','=',auth()->user()->id)->first();

        if($checkifNOrequest == null){
            if($request->amount < 50){
                return redirect()->back()->with('error', 'The minimum request is 50 pesos!');
            }else{
                $details = WalletTransaction::where('user_id','=',auth()->user()->id)
                    ->whereRaw('id = (select max(`id`) from wallet_transactions)')->first();
                
                date_default_timezone_set('Asia/Manila');
                $datetime = date("Y-m-d h:i:s"); 

                $walletRequest = new WalletTransaction;

                $walletRequest->user_id = auth()->user()->id;
                $walletRequest->previous = $details->previous;
                $walletRequest->current = $details->current;
                $walletRequest->amount = $request->amount;
                $walletRequest->type = '1';
                $walletRequest->date_time = $datetime;
                 
                if($walletRequest->save()){
                    return redirect()->back()->with('success', 'Top-up request sent!');
                }
            }
        }else{
            return redirect()->back()->with('error', 'You already sent a request!');
        }
    }
}
