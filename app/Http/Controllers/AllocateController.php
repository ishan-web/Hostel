<?php

namespace App\Http\Controllers;
use App\Models\Student_Room_Model;
use App\Models\StdDetails;

use App\Models\Rooms;
use App\Models\Users;
use Session;

use Illuminate\Http\Request;

class AllocateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
    {
        Session::put('topmenu','allocate');
        $room = Rooms::all();
        $students = StdDetails::all();
        $allocate = Student_Room_Model::all();  
        // <?php echo '<pre>'; print_r($students); exit; 

        return view('admin.allocate.index', compact('room','allocate','students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
