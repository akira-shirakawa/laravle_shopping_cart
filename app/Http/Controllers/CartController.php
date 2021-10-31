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
        $cart = Cart::findOrFail($id)->carts;
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

    public function search(Request $request)
    {
        $value = $request->input('comment');
        
        
        $cart = Cart::where('comment','like',"%".$value."%")
        ->where('user_id',Auth::id())
        ->where('created_at','>',$request->created_at_from ?? '2000-01-01' )
        ->where('created_at','<',$request->created_at_to ?? '2999-12-30')
        ->where('updated_at','>',$request->updated_at_from ?? '2000-01-01')
        ->where('updated_at','<',$request->updated_at_to ?? '2999-12-30')
        ->where('count','>',$request->count_from ?? -1)
        ->where('count','<',$request->count_to ?? 10000000)
        ->where('sum','>',$request->sum_from ?? -1)
        ->where('sum','<',$request->sum_to ?? 10000000)
        ->get();
       \Session::flash('created_at_from',$request->created_at_from);
       \Session::flash('created_at_to',$request->created_at_to);
       \Session::flash('updated_at_from',$request->updated_at_from);
       \Session::flash('updated_at_to',$request->updated_at_to);
       \Session::flash('comment',$request->comment);
       \Session::flash('count_from',$request->count_from);
       \Session::flash('count_to',$request->count_to);
       \Session::flash('sum_from',$request->sum_from);
       \Session::flash('sum_to',$request->sum_to);
        
        return view('cart',['carts'=>$cart]);
    }
}
