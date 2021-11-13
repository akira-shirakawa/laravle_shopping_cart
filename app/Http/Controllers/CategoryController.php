<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
   

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->category = $request->category;
        $category->save();
        
        return back();

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        
        return view('admin.edit_category',['category'=>$category]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->category= $request->category;
        $category->save();
        return redirect('admin/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $category = Category::find($request->id);
        $category->delete();
        return back();
    }
}
