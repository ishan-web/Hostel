<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Rooms;
use App\Models\Room_types;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('topmenu','room');
        $room = Rooms::all();
        $type = Room_types::all();
        return view('admin.room.index', compact('room','type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $room = new Rooms();
        $room->name = $request->name;
        $room->room_type_id = $request->room_type_id;
        $room->status = $request->status;
        
        return $room->save()?redirect()->back()->with('success','Room created successfully') : redirect()->back()->with('failure','Room Creation failed');
    }


    /**
     * Show the form for editing the specified resource.
     */
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