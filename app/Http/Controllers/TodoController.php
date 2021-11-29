<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $todo = Auth::user()->todos()->get();
        return response()->json(['status' => 'success','result' => $todo]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        $request->validate();
        try {
        	Auth::user()->todos()->Create($request->all());
        	return response()->json(['status' => 'success', 'msg' => 'Todo added successfully.']);
        } catch (Exception $e) {
        	return response()->json(['status' => 'fail', 'msg' => $e->getMessage()]);	
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::where('id', $id)->get();
        return response()->json($todo);
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, $id)
    {
        $request->validate();
        $todo = Todo::find($id);
        try {
        	$todo->fill($request->all())->save();
        	return response()->json(['status' => 'success', 'msg' => 'Todo updated successfully.']);
        } catch (Exception $e) {
        	return response()->json(['status' => 'failed', 'msg' => $e->getMessage()]);	
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	try {
    		Todo::destroy($id);
    		return response()->json(['status' => 'success', 'msg' => 'Todo deleted successfully.']);
    	} catch (Exception $e) {
    		return response()->json(['status' => 'failed', 'msg' => $e->getMessage()]);	
    	}
    }
}
