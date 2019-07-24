<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\User as UserResource;
use Hash;

class UserApiController extends Controller
{
    public function index()
    {
    	return UserResource::collection(User::paginate());
    }
    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users'
        ]);

    	$user =  User::create([

    		'name' => $request->name,
    		'email' => $request->email,
    		'username' => $request->username,
    		'password' => Hash::make($request->password),
    		'role_id' => 1,
    		'active' => 1
    	]);

    	return new UserResource($user);
    }

    public function show($id)
    {

        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        if($user->save()){

            return new UserResource($user);
        }
    }
    public function destroy($id){

        $user = User::findOrFail($id);

        if($user->delete()){

            return new UserResource($user);
        }
    }

    protected function formValidate(Array $data)
    {
        return $this->validate($data, [

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required',
        ]);
    }
}
