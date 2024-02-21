<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StdDetails;
use App\Models\AttendanceModel;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $att = AttendanceModel::all();
        $students = StdDetails::where('status',0)->get();
        return view('admin.attendance.index',compact('att','students'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'date' => 'required|date|unique:attendance_models,date',
        ]);

        if ($validator->fails()) {
            // Get the validation errors
            $errors = $validator->errors()->all();
            
            // Store errors in session flash data
            return redirect()->back()->with(['errors' => $errors]);
        }
        $date = $request->date;
    
        if ($request->has('status') && is_array($request->status)) {
            foreach ($request->status as $studentId => $status) {
                AttendanceModel::create([
                    'student_id' => $studentId,
                    'status' => $status,
                    'date' => $date,
                ]);
            }
        }
        
        return redirect()->back()->with('success','Attendance created successfully');
    }
    

  
    public function edit(string $id)
    {
        $att = AttendanceModel::findOrFail($id);
        $students = StdDetails::where('status',0)->get();
        return view('admin.attendance.edit',compact('att','students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'status' => 'required|array',
            'status.*' => 'required|in:0,1',
            'date' => 'required|date|unique:attendance_models,date',
        ]);
    
        // Retrieve the attendance record to update
        $attendance = AttendanceModel::findOrFail($id);
    
        // Update the status and date
        $attendance->status = $request->status[$attendance->student_id];
        $attendance->date = $request->date;
    
        // Save the changes to the database
        $attendance->save();
    
        // Redirect back with a success message
        return redirect()->to('attendance')->with('success', 'Attendance updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the attendance record by its ID
        $attendance = AttendanceModel::findOrFail($id);
    
        // Delete the attendance record
        $attendance->delete();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Attendance record deleted successfully');
    }
}
