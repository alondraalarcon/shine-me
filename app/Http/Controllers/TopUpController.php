<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WalletTransaction;
use App\Models\User;
use DB;

class TopUpController extends Controller
{
    public function topuprequest()
    {
        $requests = DB::table('wallet_transactions')
                ->leftjoin('users','users.id','=','wallet_transactions.user_id')
                ->select('wallet_transactions.*','users.name as uname', 'users.phone as uphone')
                ->where('type','=','1')
                ->orderBy('id','desc')->get();

        $approves = DB::table('wallet_transactions')
                ->leftjoin('users','users.id','=','wallet_transactions.user_id')
                ->select('wallet_transactions.*','users.name as uname', 'users.phone as uphone')
                ->whereIn('type', array(2, 4))
                ->orderBy('id','desc')->get();

        return view('admin.topup.topuprequest',compact('requests','approves'));
    }

    public function topUp_show($id)
    {
        $topUp = DB::table('wallet_transactions')
            ->leftjoin('users','users.id','=','wallet_transactions.user_id')
            ->select('wallet_transactions.*','users.name as uname', 'users.phone as uphone')
            ->where('wallet_transactions.id','=',$id)->first();

        return response()->json($topUp);
    }

    public function topUp_approve(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');
        $datetime = date("Y-m-d h:i:s");

        $details = WalletTransaction::where('id', $id)->first();
        $total = $details->current + $request->amount;

        if( $request->amount < 50){
            return response()->json(['message' => 'The minimum top-up is 50 pesos!', 'code' => 0]);
        }else{
            $topUpapprove = WalletTransaction::where('id', $id)
                ->update(['type' => "2", 'date_time'=>$datetime,'previous' => $details->current,
                'current' => $total, 'amount' => $request->amount]);  
                
            User::where('id',$details->user_id)
                ->update(['wallet'=>$total]);  

            return response()->json(['message' => 'Top-Up approves successfully!', 'code' => 1]);
        }   
    }

    public function topUp_rejectshow($id)
    {
        $topUpDetails = DB::table('wallet_transactions')
            ->leftjoin('users','users.id','=','wallet_transactions.user_id')
            ->select('wallet_transactions.*','users.name as uname', 'users.phone as uphone')
            ->where('wallet_transactions.id','=',$id)->first();

        return response()->json($topUpDetails);
    }

    public function topUp_reject(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');
        $datetime = date("Y-m-d h:i:s");
    
        $topUpreject = WalletTransaction::where('id', $id)
            ->update(['type' => "4", 'message' => $request->message]);   

        return response()->json(['message' => 'Top-Up rejected successfully!', 'code' => 1]);
    }
}
