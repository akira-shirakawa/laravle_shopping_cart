<?php

namespace App\UseCase\sale;

use App\Cart;
use App\Sale;
use App\Item;
use Auth;


class CreateSaleUseCase
{  
    public function handle($request)
    {   $item_id = $request['item_id'];
        if(Sale::where('item_id',$item_id)->where('user_id',Auth::user()->id)->where('cart_id',$request['cart_id'] ?? null)->exists())
        {
           
            $sale = Sale::where('item_id',$item_id)->where('user_id',Auth::user()->id)->where('cart_id',$request['cart_id'] ?? null)->get()[0];           
            $sale->amount = $sale->amount+1;
            $sale->save();
           
        }else{

            if($request['cart_id'] ?? ''){
               Sale::create([
                'item_id'=>$item_id,
                'amount'=>1,
                'user_id'=>Auth::user()->id,
                'cart_id'=>$request['cart_id'],
                'price'=>Item::find($item_id)->price 
               ]) ;
            }else{
                Sale::create([
                    'item_id'=>$item_id,
                    'amount'=>1,
                    'user_id'=>Auth::user()->id
                ]);

            }
        }
       

    }

}
