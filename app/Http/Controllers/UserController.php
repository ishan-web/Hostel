<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

use DB;
use Hash;
use Session;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Session::put('topmenu','auth');
        Session::put('menu','user');
        $roles = Role::pluck('name','name')->all();
        $data = User::orderBy('id','DESC')->get();

        // echo'<pre>'; print_r($rooms); exit;
        return view('admin.authorization.users.index',compact('data','roles'))
                ->with('i', ($request->input('page', 1) - 1) * 5);    }

    public function store(Request $request)
    {

    $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
        ]);

        if ($validator->fails()) {
            // Get the validation errors
            $errors = $validator->errors()->all();
            
            // Store errors in session flash data
            return redirect()->back()->with(['errors' => $errors]);
        }
        $user = new User();

        $user->name = $request->name;

        $user->email = $request->email;

        $user->password = Hash::make($request->password);

        $user->user_type = implode(',', $request->input('roles'));

        $user->assignRole($request->input('roles'));


        return $user->save()?redirect()->back()->with('success','User saved successfully') : redirect()->back()->with('failure','Save User failed');

            }

    
        public function update(Request $request, $id)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
            ]);
            if ($validator->fails()) {
                // Get the validation errors
                $errors = $validator->errors()->all();
                
                // Store errors in session flash data
                return redirect()->back()->with(['errors' => $errors]);
            }
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->user_type = implode(',', $request->input('roles'));

            $user->syncRoles($request->input('roles'));

       
            return $user->save()
                    ? redirect()->route('users.index')->with('success','User updated successfully')
                    : redirect()->back()->with(['failure' => 'User Update failed']);;
        }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
