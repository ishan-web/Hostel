<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\permissioncategories;
use DB;
use Session;
class permissionController extends Controller
{

    public function index()
    {
        Session::put('topmenu','auth');
        Session::put('menu','permission');
        $percategory = permissioncategories::all();
        $permission = Permission::all();
        return view('admin.authorization.permission.index',compact('percategory','permission'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
        ]);
       
            $permission = new Permission;
            $permission->name = $request->name;
            $permission->permissioncategory_id= $request->category;
            $permission->guard_name = "web";
            return $permission->save()?redirect()->back()->with('success','Permission created successfully') : redirect()->back()->with('failure','Creating permission failed');
        
    }

    public function update(Request $request, $id)
{

    $permission = Permission::findOrFail($id);
    $permission->name = $request->name;
    $permission->permissioncategory_id= $request->category;
    $permission->guard_name = "web";
    return $permission->save()?redirect()->back()->with('success','Permission Edited successfully') : redirect()->back()->with('failure','Editing permission failed');
}

    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        return $permission->delete()?redirect()->back()->with('success','Permission Deleted successfully') : redirect()->back()->with('failure','Deleting permission failed');
    }
}
