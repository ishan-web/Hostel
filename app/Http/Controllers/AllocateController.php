<?php

namespace App\Http\Controllers;
use App\Models\Student_Room_Model;
use App\Models\StdDetails;
use Illuminate\Support\Facades\Validator;
use App\Models\Rooms;
use App\Models\Users;
use Session;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Response; // Import Response class


use Illuminate\Http\Request;

class AllocateController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     function __construct()
     {
         $this->middleware('permission:view-allocate', ['only' => ['index']]);
         $this->middleware('permission:edit-allocate', ['only' => ['index','edit', 'update', 'destroy', 'store']]);
     }
     
   
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
        
     
        $data = [
            'room_id' =>$request->room_id,
            'student_id' => $request->student_id
        ];

        $room = $request->room_id;
    
        $allocate = new Student_Room_Model();
        $result = $allocate->insert($data, $room);


        if ($result) {
            return redirect()->back()->with('success', 'Student added successfully');
        } else {
                        
            return redirect()->back()->with('failure', 'Room is packed');
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Rooms::all();
        $students = StdDetails::all();
        $allocate = Student_Room_Model::findOrFail($id);  

        return view('admin.allocate.edit', compact('room','allocate','students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            'room_id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            // Get the validation errors
            $errors = $validator->errors()->all();
            
            // Store errors in session flash data
            return redirect()->back()->with(['errors' => $errors]);
        }
        
     
        $data = [
            'room_id' =>$request->room_id,
            'student_id' => $request->student_id
        ];

        $allocate = Student_Room_Model::findOrFail($id);
        $result = $allocate->update($data, ['id' => $id]);

        if ($result) {
            return redirect()->to('allocate')->with('success', 'Student updated successfully');
        } else {
            return redirect()->back()->with('failure', 'Room is packed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Find the allocation record by its ID
    $allocate = Student_Room_Model::findOrFail($id);
    
    // Delete the allocation record
    $allocate->delete();
    
    // Check if the allocation record was successfully deleted
    if($allocate)
    {
        return redirect()->to('allocate')->with('success', 'Student deleted successfully');
    }
    else 
    {
        return redirect()->to('allocate')->with('error', 'Student deletion failed');
    }
}

}
