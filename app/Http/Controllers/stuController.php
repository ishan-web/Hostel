<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StdDetails;
use Illuminate\Support\Facades\Auth;

class stuController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $student = StdDetails::where('user_id', $id)->first();

        return view('user.profile.index', compact('student')); // Passed the cost to the view
    }        


    
}
