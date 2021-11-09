<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sale;
class Cart extends Model
{
    protected $fillable=[
        'comment',
        'sum',
        'count',
        'user_id'
    ];
    public function carts()
    {
        return $this->hasMany('App\Sale');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item','sales');
        
    }
    public function getCategory($cart_id)
    {   
        $category = Category::
        join('items','categories.id','items.category_id')
        ->join('sales','sales.item_id','items.id')
        ->join('carts','carts.id','sales.cart_id')
        ->where('carts.id',$cart_id)
        ->get()
        ->unique('category');
           
        return $category;
    }
    
    
    
}
