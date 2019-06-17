<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;
use DB;
use DataTables;

class UsersController extends Controller
{
    public function index(){

    	return view('pages.users.index');

    }
    public function create(){

        $roles = Role::select(['id', 'display_name'])->get();
        
        return view('pages.users.create')->with('roles', $roles);
    }
    public function store(Request $request){

        //validation
        $request->validate([

            'email' => 'unique:users',
            'username' => 'unique:users',
            'password' => 'confirmed|min:6'
        ], [

            'email.unique' => 'email is already taken',
            'username.unique' => 'username is already taken',
            'password.confirmed' => 'password mismatched',
            'password.min' => 'password must be atleast 6 characters'
        ]);


    	DB::beginTransaction();

    	try {

    		User::create([

	    		'name' => $request->name,
	    		'email' => $request->email,
	    		'username' => $request->username,
	    		'password' => Hash::make($request->password),
	    		'role_id' => $request->role,
	    		'active' => true
	    	]);
    		
    	} catch (Exception $e) {
    		
    		DB::rollback();

    		return redirect()->route('users')->with('message', $e->getMessage());
    	}

    	DB::commit();

    	return redirect()->route('users')->with('message', 'User added successfully!');
    	
    }
    public function edit($id)
    {
        $user = User::findorFail($id);
        $roles = Role::all();

        return view('pages.users.edit')
        ->with('roles', $roles)
        ->with('user', $user);
    }
    public function update($id, Request $request)
    {

        /* Validation */
        
        $user = User::findOrFail($id);
        $data = [

            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role_id' => $request->role,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
        ];

        //update new stored data
        DB::beginTransaction();

        try {

            User::where('id', $id)->update($data);
            
        } catch (Exception $e) {
            
            DB::rollback();

            return redirect()->route('user.edit', ['id' => $id])->with('message', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('users')->with('message', 'Updated Successfully');
        
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            
            User::where('id', $id)->delete();

        } catch (Exception $e) {
            
            DB::rollback();

            return response()->json('exception', $e->getMessage());
        }

        DB::commit();

        return response()->json(['success' => 'Deleted successfully']);
    }
    public function updateStatus($id){

        $user = User::findOrFail($id);

        if($user->active == true){

            User::where('id', $user->id)->update(['active' => false]);
        }else{

            User::where('id', $user->id)->update(['active' => true]);
        }

        return redirect()->route('user.edit', ['id' => $id]);
    }
    public function usersData(){

    	return DataTables::of(User::whereNotIn('id', [auth()->user()->id]))

    	->addColumn('roles', function(User $user){

    		return "<span class='label label-primary'>{$user->role->display_name}</span>";

    	})->addColumn('status', function(User $user){

    		$status = $user->active == true ? 'Active' : 'Inactive';
    		$class = $user->active == true ? 'label label-success' : 'label label-danger';

    		return "<span class='{$class}'>{$status}</span>";

    	})
    	->addColumn('action', function(User $user){

            $url = route('user.edit', ['id' => $user->id]);

    		return "<a href='{$url}' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-edit'></i></a>
                    <button type='button' onclick='deleteUser({$user->id})' class='btn btn-danger btn-sm btn-flat'><i class='fa fa-trash'></i></button>
            ";
    	})
    	->rawColumns(['roles', 'status', 'action'])
    	->make(true);
    }
}
