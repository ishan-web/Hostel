<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\permissioncategories;
use Session;

class permissioncategoryController extends Controller
{

    
    public function index()
    {
        Session::put('topmenu','auth');
        Session::put('menu','permission_group');
        $list = permissioncategories::all();
        return view('admin.authorization.percategory.index',compact('list'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        if($id==""){
            $percategory = new permissioncategories;
            $percategory->name = $request->name;
            return $percategory->save()?redirect()->back()->with('success','Permission Category Added Successfully') : redirect()->back()->with('failure','Permission Category Adding Failed');
        }else{
            $percategory = permissioncategories::findOrFail($id);
            $percategory->name = $request->name;
            return $percategory->save()?redirect()->back()->with('success','Permission Category Updated Successfully') : redirect()->back()->with('failure','Permission Category Updating Failed');
        }
    }

    public function destroy(string $id)
    {
        $percategory = permissioncategories::findOrFail($id);
        return $percategory->delete()?redirect()->back()->with('success','Permission Category Deleted Successfully') : redirect()->back()->with('failure','Permission Category Deletion Failed');
    }
}
