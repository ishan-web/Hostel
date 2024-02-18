<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\StdDetails;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('topmenu','std');
        $std = StdDetails::all();
        $users = User::where('user_type', 'student')->get();
        return view('admin.student.index', compact('std','users'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',           
            'user_id' => 'required|unique:std_details,user_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);
    
        if ($validator->fails()) {
            // Get the validation errors
            $errors = $validator->errors()->all();
            
            // Store errors in session flash data
            return redirect()->back()->with(['errors' => $errors]);
        }
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Move image to public/images directory
        } else {
            $imageName = null; // If no image uploaded, set imageName to null
        }
    
        // Create a new instance of your model and set its attributes
        $student = new StdDetails();
        $student->name = $request->name;        
        $student->address = $request->address;
        $student->phone = $request->phone;
        $student->dob = $request->dob;
        $student->gender = $request->gender;
        $student->status = $request->status;
        $student->user_id = $request->user_id;
        $student->image = $imageName; // Save the image name to the database
    
        // Save the student record
        $student->save();
    
        return redirect()->route('student')->with('success', 'Student added successfully');
    }

    public function edit(string $id)
    {
        $student = StdDetails::findOrFail($id);
        $users = User::where('user_type', 'student')->get();

        return view('admin.student.edit', compact('student','users'));
    }
   
    
    public function update(Request $request, string $id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',           
        'user_id' => 'required|unique:std_details,user_id,'.$id, // Allow the user_id to be the same for the current record
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
    ]);

    if ($validator->fails()) {
        // Get the validation errors
        $errors = $validator->errors()->all();

        // Store errors in session flash data
        return redirect()->back()->with(['errors' => $errors]);
    }

    $student = StdDetails::findOrFail($id);

    $student->name = $request->name;        
    $student->address = $request->address;
    $student->phone = $request->phone;
    $student->dob = $request->dob;
    $student->gender = $request->gender;
    $student->user_id = $request->user_id;
    $student->status = $request->status;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName); // Move image to public/images directory
        $student->image = $imageName; // Update the image name in the database
    }

    $student->save();

    return redirect()->to('student')->with('success', 'Student updated successfully');
}
public function destroy(string $id)
{
    // Find the record by ID
    $student = StdDetails::findOrFail($id);

    // Delete the record
    $student->delete();

    // Redirect back with success message
    return redirect()->to('student')->with('success', 'Student deleted successfully');
}


    
}
