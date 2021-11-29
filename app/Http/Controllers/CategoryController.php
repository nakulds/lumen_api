<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Auth::user()->categories()->get();
        return response()->json(['status' => 'success','result' => $category]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->validate();
        try {
        	Auth::user()->categories()->create($request->all());
        	return response()->json(['status' => 'success', 'msg' => 'Category added successfully.']);
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
        $category = Category::where('id', $id)->get();
        return response()->json($category);
        
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
    public function update(Request $request, $id)
    {
        $request->validate();
        $category = Category::find($id);
        try {
        	$category->fill($request->all())->save();
        	return response()->json(['status' => 'success', 'msg' => 'Category updated successfully.']);
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
    		Category::destroy($id);
    		return response()->json(['status' => 'success', 'msg' => 'Category deleted successfully.']);
    	} catch (Exception $e) {
    		return response()->json(['status' => 'failed', 'msg' => $e->getMessage()]);	
    	}
    }
}
