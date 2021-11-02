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
        'user_id',
        'category_id'
    ];
    public function getOriginalPrice($item_id,$cart_id)
    {
        $price = Sale::where('item_id',$item_id)->where('cart_id',$cart_id)->where('user_id',Auth::id())->first();
        
       
        return $price->price ?? '';
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
