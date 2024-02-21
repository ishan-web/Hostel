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
        $percategory = new permissioncategories;
        $percategory->name = $request->name;
        return $percategory->save()?redirect()->back()->with('success','Permission Category Added Successfully') : redirect()->back()->with('failure','Permission Category Adding Failed');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $permissionCategory = permissioncategories::findOrFail($id);

        if (!$permissionCategory) {
            return redirect()->back()->with('error', 'Permission category not found.');
        }

        $permissionCategory->name = $request->input('name');

        $permissionCategory->save();

        return redirect()->back()->with('success', 'Permission category updated successfully.');
    }

    public function destroy(string $id)
    {
        $percategory = permissioncategories::findOrFail($id);
        return $percategory->delete()?redirect()->back()->with('success','Permission Category Deleted Successfully') : redirect()->back()->with('failure','Permission Category Deletion Failed');
    }
}
