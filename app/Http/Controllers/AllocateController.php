<?php

namespace App\Http\Controllers;
use App\Models\Student_Room_Model;
use App\Models\StdDetails;
use Illuminate\Support\Facades\Validator;
use App\Models\Rooms;
use App\Models\Users;
use Session;
use Illuminate\Http\Response; // Import Response class


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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer|unique:student__room__models,student_id',
            'room_id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            // Get the validation errors
            $errors = $validator->errors()->all();
            
            // Store errors in session flash data
            return redirect()->back()->with(['errors' => $errors]);
        }
        
     
        $studentId = $request->student_id;
        $roomId = $request->room_id;
    
        $allocate = new Student_Room_Model();
        $allocate->insert($studentId, $roomId);
    
        if ($allocate) {
            return redirect()->back()->with('success', 'Student added successfully');
        } else {
            return redirect()->back()->with('failed', 'Room is packed');
        }
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
