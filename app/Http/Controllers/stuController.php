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
        $st_id = StdDetails::getStudent($id);

        $student = StdDetails::where('user_id', $id)->first();
        $room = StdDetails::getCost($st_id->id);

        return view('user.profile.index', compact('student','room')); 
    }        


    
}
