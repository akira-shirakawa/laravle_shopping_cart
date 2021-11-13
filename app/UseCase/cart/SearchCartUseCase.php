<?php
namespace App\UseCase\cart;
use App\Cart;
use Auth;
class SearchCartUsecase
{
    public function handle($request)
    {

        
        
        
        $cart = Cart::select('carts.*')->
        join('sales','carts.id','sales.cart_id')->
        join('items','sales.item_id','items.id')->
        join('categories','items.category_id','categories.id')->
        where('comment','like',"%".$request['comment']."%")
        ->where('carts.user_id',Auth::id())
        ->where('carts.created_at','>',$request['created_at_from'] ?? '2000-01-01' )
        ->where('carts.created_at','<',$request['created_at_to'] ?? '2999-12-30')
        ->where('carts.updated_at','>',$request['updated_at_from'] ?? '2000-01-01')
        ->where('carts.updated_at','<',$request['updated_at_to'] ?? '2999-12-30')
        ->where('carts.count','>',$request['count_from'] ?? -1)
        ->where('carts.count','<',$request['count_to'] ?? 10000000)
        ->where('carts.sum','>',$request['sum_from'] ?? -1)
        ->where('carts.sum','<',$request['sum_to'] ?? 10000000)
        ->where('categories.category','like',"%".$request['category']."%")       
        ->get()
        ->unique('id');
       
       
       \Session::flash('created_at_from',$request['created_at_from']);
       \Session::flash('created_at_to',$request['created_at_to']);
       \Session::flash('updated_at_from',$request['updated_at_from']);
       \Session::flash('updated_at_to',$request['updated_at_to']);
       \Session::flash('comment',$request['comment']);
       \Session::flash('count_from',$request['count_from']);
       \Session::flash('count_to',$request['count_to']);
       \Session::flash('sum_from',$request['sum_from']);
       \Session::flash('sum_to',$request['sum_to']);

       return $cart;
    }
}