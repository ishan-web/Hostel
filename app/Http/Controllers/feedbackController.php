<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
class feedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feed = Feedback::all();
        return view('user.feedback.index',compact('feed'));
    }

  
    public function store(Request $request)
    {
        $feed = new Feedback();
        $feed->name = Auth::user()->name;
        $feed->post = $request->post;
        
        return $feed->save()?redirect()->back()->with('success','Post created successfully') : redirect()->back()->with('failure','Post Creation failed');
    }


}
