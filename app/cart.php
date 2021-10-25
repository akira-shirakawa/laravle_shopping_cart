<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
