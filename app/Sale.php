<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Item;
class Sale extends Model
{   
    protected $fillable=[
        'item_id',
        'amount',
        'cart_id',
        'price',
        'user_id',
    ];
    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public static function sumSale($user_id,$cart_id=null)
    {   $sum=0;
        $sale = self::where('user_id',$user_id)->where('cart_id',$cart_id)->get();
        foreach($sale as $value){
            $sum+=$value->amount*$value->item->price;
        }
        return $sum;

    }

   
}
