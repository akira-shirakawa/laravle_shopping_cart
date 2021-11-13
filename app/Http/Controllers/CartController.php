<?php

namespace App\Http\Controllers;
use App\UseCase\cart\CreateCartUseCase;
use App\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Sale;
use App\Item;
use App\Category;
use App\UseCase\cart\SearchCartUsecase;
use Auth;


class CartController extends Controller
{   public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = collect(Cart::where('user_id',Auth::id())->get());
        

        $category = Category::all();
       
        return view('cart',['carts'=>$cart,'category'=>$category]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $useCase = new CreateCartUseCase();
        $useCase->handle($request->all());
        
        return redirect('/');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cart = Cart::findOrFail($id)->carts;
        $item = Item::all();
        $sum = Sale::sumSale(Auth::id(),$id);
        return view('updateCart',['items'=>$item,'cart'=>$cart,'sum'=>$sum,'id'=>$id]);
    }

    public function update(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        $cart->comment = $request->comment;
        $cart->save();
        return redirect('/cart');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        $cart->delete();
        return redirect('/cart');
    }

    public function search(Request $request)
    {
        $useCase = new SearchCartUsecase();
        $cart = $useCase->handle($request->all());
        
        return view('cart',['carts'=>$cart,'category'=>Category::all()]);
    }
}
