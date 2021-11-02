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
}