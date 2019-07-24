<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Todo;
use App\Http\Resources\Todo as TodoResource;

class TodoController extends Controller
{
    public function index()
    {

    	$todos = Todo::all();

    	return TodoResource::collection($todos);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [

    		'todo' => 'required'
    	]);

    	$data = new Todo;
    	$todo = Todo::create($data->todoData($request->toArray()));

    	return new TodoResource($todo, 200);
    }

    public function show($id)
    {
    	$todo = Todo::findOrFail($id);

    	return new TodoResource($todo, 200);
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [

    		'todo' => 'required'
    	]);

    	$todo = Todo::findOrFail($id);
    	$todo->todo = $request->todo;

    	if($todo->save()){

    		return new TodoResource($todo, 200);

    	}
    }

    public function destroy($id)
    {
    	$todo = Todo::findOrFail($id);
    	$todo->delete();

    	return new TodoResource($todo, 200);
    }
}
