<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room_types;


class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = Room_types::all();
        return view('admin.type.index', compact('type'));
            }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = new Room_types();
        $type->name = $request->name;
        $type->capacity = $request->capacity;
        return $type->save()?redirect()->back()->with('success','Room Type created successfully') : redirect()->back()->with('failure','Room Type Creation failed');
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
