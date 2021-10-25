<?php

namespace App\Http\Controllers;
use App\UseCase\cart\CreateCartUseCase;
use App\Cart;
use Illuminate\Http\Request;
use App\Sale;
use App\Item;
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
        $cart = Cart::where('user_id',Auth::id())->get();
        return view('cart',['carts'=>$cart]);
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
        $cart = Cart::find($id)->carts;
        $item = Item::all();
        $sum = Sale::sumSale(Auth::id(),$id);
        return view('updateCart',['items'=>$item,'cart'=>$cart,'sum'=>$sum,'id'=>$id]);
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
}
