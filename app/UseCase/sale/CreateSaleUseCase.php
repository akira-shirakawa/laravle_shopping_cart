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
            if($request['cart_id'] ?? ''){
                $cart =Cart::find($request['cart_id']);
                
                $cart->sum = $cart->sum+Sale::where('user_id',Auth::id())->where('cart_id',$request['cart_id'])->where('item_id',$item_id)->get()->first()->price;
                $cart->count = $cart->count+1;
                $cart->save();
            }
            

           
        }else{

            if($request['cart_id'] ?? ''){
               Sale::create([
                'item_id'=>$item_id,
                'amount'=>1,
                'user_id'=>Auth::user()->id,
                'cart_id'=>$request['cart_id'],
                'price'=>Item::find($item_id)->price 
               ]) ;
                $cart =Cart::find($request['cart_id']);
                $price = Item::find($request['item_id'])->price;
                $cart->sum = $cart->sum+$price;
                $cart->count = $cart->count+1;
                $cart->save();
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
