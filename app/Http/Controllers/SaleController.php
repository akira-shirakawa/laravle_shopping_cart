<?php

namespace App\Http\Controllers;

use App\Sale;
use App\UseCase\sale\CreateSaleUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SaleController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
       $sale = new CreateSaleUseCase();
       $sale->handle($request->all());
        
        return back();
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
        DB::beginTransaction();
        try{

        $sale = Sale::find($request->item_id);
        

        $cart = Sale::find($request->item_id)->cart;
        $num = $sale->amount;
        $price = $sale->price;
        
        $cart->sum = $cart->sum+$price*((int)$request->amount - $num);
        $cart->count = $cart->count +((int)$request->amount - $num);
        $cart->save();

        $sale->amount = $request->amount;
        $sale->save();
        DB::commit();
        return back();
        }catch(\Throwable $e){

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try{
        $sale = Sale::find($request->item_id);
       
        
        $cart = Sale::find($request->item_id)->cart;
        
        $num = $sale->amount;
        $price = $sale->price;

        $cart->sum = $cart->sum - $num*$price;
        $cart->count = $cart->count - $num;
       
        $cart->save();

        $sale->delete();
        if($cart->carts->count() == 0){
            
            $cart->delete();
            DB::commit();
            return redirect('/cart');
        }
        DB::commit();
        return back();
        }catch(\Throwable $e){
            dd($e);
        }
        
    }
}
