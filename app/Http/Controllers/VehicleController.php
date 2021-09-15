<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $output['vehicles'] = Vehicle::get();
        return view('admin.vehicles.index', $output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'type' => 'required',
            'price' => 'required',
            'status' => 'required',
       ]);

       $vehicle = new Vehicle;
       $vehicle->Type = $request->type;
       $vehicle->price = $request->price;
       $vehicle->status = $request->status;
<<<<<<< HEAD
     
=======

>>>>>>> e15b642297ec773320f298b978c585584093e1e5
       if($vehicle->save()) {
            return redirect()->back()->with('success', 'New vehicle added successfully!');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);
        return response()->json($vehicle);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'price' => 'required',
            'status' => 'required',
       ]);

       $vehicle = Vehicle::find($id);
       $vehicle->Type = $request->type;
       $vehicle->price = $request->price;
       $vehicle->status = $request->status;
<<<<<<< HEAD
     
=======

>>>>>>> e15b642297ec773320f298b978c585584093e1e5
       if($vehicle->save()) {
            return redirect()->back()->with('success', 'Vehicle updated successfully!');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        if($vehicle->delete()) {
            return redirect()->back()->with('success', 'Vehicle deleted successfully!');
       }
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> e15b642297ec773320f298b978c585584093e1e5
