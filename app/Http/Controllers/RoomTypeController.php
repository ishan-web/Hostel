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
        $type->cost = $request->cost;

        return $type->save()?redirect()->back()->with('success','Room Type created successfully') : redirect()->back()->with('failure','Room Type Creation failed');
    }

  
    public function edit(string $id)
    {
        $type = Room_types::findOrFail($id);
        return view('admin.type.edit', compact('type'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type = Room_types::findOrFail($id);
        $type->name = $request->name;
        $type->capacity = $request->capacity;
        $type->cost = $request->cost;

        return $type->save()?redirect()->back()->with('success','Room Type updated successfully') : redirect()->back()->with('failure','Room Type update failed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // Find the allocation record by its ID
    $type = Room_types::findOrFail($id);
    
    // Delete the allocation record
    $type->delete();
    
    // Check if the allocation record was successfully deleted
    if($type)
    {
        return redirect()->to('type')->with('success', 'Type deleted successfully');
    }
    else 
    {
        return redirect()->to('type')->with('error', 'Type deletion failed');
    }
    }
}
