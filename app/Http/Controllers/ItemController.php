<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Sale;

use Auth;
use Illuminate\Support\Facades\DB;


class ItemController extends Controller
{   public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::all();
        $sale = Sale::where('user_id',Auth::id())->where('cart_id',null)->get();
        $sum = Sale::sumSale(Auth::id());
        
        return view('index',['items'=>$item,'sale'=>$sale,'sum'=>$sum]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Item::all();
        return view('item',['item'=>$item]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($file = $request->image){
            
            $fileName = time().'.'.$file->getClientOriginalExtension();          
            $target_path = public_path('/uploads/');
            $file->move($target_path,$fileName);
            Item::create($request->all()+['file_name'=>$fileName]);
        }else{
            $fileName = 'none_image32310901.png';        
            Item::create($request->all()+['file_name'=>$fileName]);
        }
        $item = Item::all();
        return view('item',['item'=>$item]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return view('updateItem',['item'=>$item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($file = $request->image){
            
            $fileName = time().'.'.$file->getClientOriginalExtension();          
            $target_path = public_path('/uploads/');
            $file->move($target_path,$fileName);
            Item::find($request->item_id)->update($request->all()+['file_name'=>$fileName]);
        }else{
            $fileName = 'none_image32310901.png';        
            Item::find($request->item_id)->update($request->all()+['file_name'=>$fileName]);
        }
        $item = Item::all();
        return view('item',['item'=>$item]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    { 
        DB::beginTransaction();
        try{
            $item = Item::find($request->id);
            
            $item->delete();
    
            $sale = Sale::where('item_id',$request->id);
            $sale->delete();
    

            DB::commit();
        }catch(\Throwable $e){
            DB::rollback();
            dd($e);
        }
       

        return redirect('/item');

    }
}
