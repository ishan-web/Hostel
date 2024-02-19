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


    public function edit(string $id)
    {
        $room = Rooms::findOrFail($id);
        $type = Room_types::all();
        return view('admin.room.edit', compact('room','type'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = Rooms::findOrFail($id);
        $room->name = $request->name;
        $room->room_type_id = $request->room_type_id;
        $room->status = $request->status;
        
        return $room->save()?redirect()->back()->with('success','Room Updated successfully') : redirect()->back()->with('failure','Room Update failed');
    }

}
