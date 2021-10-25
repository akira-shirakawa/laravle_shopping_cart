<?php

namespace App\Http\Controllers;

use App\Sale;
use App\UseCase\sale\CreateSaleUseCase;
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
       $sale = new CreateSaleUseCase();
       $sale->handle($request->all());
  
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
