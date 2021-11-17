<?php
 
namespace App\Http\Controllers\Admin;  
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');  
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('admin.home',['categories'=>$category]);  
    }
    public function user()
    {
        $user = User::all();
        return view('admin.user',['users'=>$user]);
    }
    public function searchUserOnInput(Request $request)
    {
        
        $user = User::where('name','like',"%".$request->user."%")->count();
       
        return $user;
    }
    public function searchUser(Request $request)
    {
        $user = User::where('name','like',"%$request->user%")->get();
        return $user;
    }
}