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
    
    
    
}
