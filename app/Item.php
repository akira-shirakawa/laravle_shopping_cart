<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Sale;
class Item extends Model
{
    protected $fillable =[
        'name',
        'caption',
        'file_name',
        'price',
        'user_id'
    ];
    public function getOriginalPrice($item_id,$cart_id)
    {
        $price = Sale::where('item_id',$item_id)->where('cart_id',$cart_id)->where('user_id',Auth::id())->get()[0];
       
        return $price->price ?: '';
    }
}