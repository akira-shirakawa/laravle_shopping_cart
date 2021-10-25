<?php

namespace App\UseCase\cart;

use App\Cart;
use App\Sale;
use App\Item;
use Auth;
use Illuminate\Support\Facades\DB;

class CreateCartUseCase
{  
    public function handle($array)
    {   DB::beginTransaction();
        try{
            $sale = Sale::where('cart_id',null)->where('user_id',Auth::id())->get();
            foreach($sale as $value){
                $item_id = $value->item_id;
                $id = $value->id;
                $price = Item::find($item_id)->price;
                $sale_target = Sale::find($id);
                $sale_target->price=$price;
                $sale_target->save();
            }
            Cart::create($array+['user_id'=>Auth::id()]);


            $sum = Sale::all()->where('user_id',Auth::id())->where('cart_id',null);
            $sum=(int)$sum->map(function($sum){return $sum->item->price * $sum->amount;})->sum();
            $count = (int)Sale::where('user_id',Auth::id())->where('cart_id',null)->sum('amount');
           
            $first = Cart::latest()->get()[0]->id;
            
            $cart = Cart::find($first);
            $cart->sum = $sum;
            $cart->count =$count;
            $cart->save();

            Sale::where('cart_id',null)->where('user_id',Auth::id())->update(['cart_id'=>$first]);

            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            dd($e);
           
        };
        
       

    }

}
