<?php

namespace App\Http\Controllers;

use App\Sale;

use Illuminate\Http\Request;
use Auth;
class SaleController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if(Sale::where('item_id',$request->item_id)->where('user_id',Auth::user()->id)->where('cart_id',null)->exists())
        {
           
            $sale = Sale::where('item_id',$request->item_id)->where('user_id',Auth::user()->id)->where('cart_id',null)->get()[0];           
            $sale->amount = $sale->amount+1;
            $sale->save();
           
        }else{
            Sale::create([
                'item_id'=>$request->item_id,
                'amount'=>1,
                'user_id'=>Auth::user()->id
            ]);
        }
  
        return redirect('/');
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $sale = Sale::find($request->item_id);
        $sale->amount = $request->amount;
        $sale->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sale = Sale::find($request->item_id);
        $sale->delete();
        return redirect('/');
    }
}
