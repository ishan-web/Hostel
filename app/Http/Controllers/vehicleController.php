<?php

namespace App\Http\Controllers;

use App\Models\vehicle;
use Illuminate\Http\Request;
use Session;

class vehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('topmenu','vehicle');
        $vehicle = vehicle::all();
        return view('admin.vehicle.index', compact('vehicle'));

    }

    public function store(Request $request)
    {
        $vehicle = new  vehicle();
        $vehicle->name = $request->name;
        $vehicle->number = $request->number;
        $vehicle->wheel = $request->wheel;
        $vehicle->category = $request->category;
        $vehicle->capacity = $request->capacity;
        $vehicle->driver = $request->driver;

        return $vehicle->save()?redirect()->back()->with('success','Vehicle created successfully') : redirect()->back()->with('failure','Vehicle Creation failed');
    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
