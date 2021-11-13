<?php

namespace App\Http\Controllers;

use App\Ajax;
use App\Category;
use Illuminate\Http\Request;
use Auth;
class AjaxController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ajax');
    }

    public function getData()
    {
        $data = Ajax::where('user_id',Auth::id())->get();
        return $data;
    }

    public function isUnique($category)
    {   
        $response = Category::where('category',$category)->get();
       
        return $response;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ajax = new Ajax();
        $ajax->post = $request->post;
        $ajax->user_id = Auth::id();
        $ajax->save();
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */
    public function show(Ajax $ajax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */
    public function edit(Ajax $ajax)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajax $ajax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ajax  $ajax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ajax = Ajax::find($request->post);
        $ajax->delete();
    }
}
