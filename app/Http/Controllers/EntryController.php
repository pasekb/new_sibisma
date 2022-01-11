<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Sale;
use App\Models\Out;
use App\Models\Dealer;
use App\Models\Stock;
use App\Models\StockHistory;
use Carbon\Carbon;
use Auth;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = Stock::all();
        $dealer = Dealer::orderBy('id','asc')->get();
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $data = Entry::where('entry_date',$today)->orderBy('id','desc')->get();

        return view('page', compact('stock','dealer','today','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        // Get Stok ID from Input
        $stockId = $req->stock_id;

        // Get Latest Stok from Stock Table
        $latestStock = Stock::where('id',$stockId)->sum('qty');

        // Get Entry QTY
        $entryQty = $req->in_qty;

        // Update Stock
        $updateStock = $latestStock + $entryQty;

        $data = new Entry;
        $data->entry_date = $req->entry_date;
        $data->stock_id = $req->stock_id;
        $data->dealer_id = $req->dealer_id;
        $data->in_qty = $req->in_qty;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();

        // Update Stock Table
        $stock = Stock::where('id',$stockId)->first();
        $stock->qty = $updateStock;
        $stock->updated_by = Auth::user()->id;
        $stock->save();

        /** ============== Create Or Update Stock History ============== */ 
        $isSale = Sale::where('sale_date',$req->entry_date)->count();
        $isOut = Out::where('out_date',$req->entry_date)->count();
        $isEntry = Entry::where('entry_date',$req->entry_date)->count();

        // Count first stock
        $stock = Stock::sum('qty');
        $in = Entry::where('entry_date',$req->entry_date)->sum('in_qty');
        $in = ($in == 0) ? $in = 0 : (int)$in ;
        $out = Out::where('out_date',$req->entry_date)->sum('out_qty');
        $out = ($out == 0) ? $out = 0 : (int)$out ;
        $sale = Sale::where('sale_date',$req->entry_date)->sum('sale_qty');
        $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;


        $firstStock = $stock - ($in + $out + $sale);

        if ($isSale > 0 || $isOut > 0 || $isEntry > 0) {
            // If one of them have records -> Update History
            $his = StockHistory::where('history_date',$req->entry_date)->first();
            $his->in_qty = $in;
            $his->out_qty = $out;
            $his->sale_qty = $sale;
            $his->last_stock = $stock;
            $his->updated_by = Auth::user()->id;
            $his->save();
        } else {
            // If no record by input date in DB -> Create History
            $his = new StockHistory;
            $his->history_date = $req->entry_date;
            $his->dealer_id = $req->dealer_id;
            $his->first_stock = $firstStock;
            $his->in_qty = $in;
            $his->out_qty = $out;
            $his->sale_qty = $sale;
            $his->last_stock = $stock;
            $his->created_by = Auth::user()->id;
            $his->updated_by = Auth::user()->id;
            $his->save();
        }
        /** ============== END Create Or Update Stock History ============== */ 

        toast('Data entry berhasil disimpan','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id){
        // Get Stock ID from Entry Table
        $stockId = Entry::where('id',$id)->pluck('stock_id');

        // Get Latest Stock from Stock Table
        $latestStock = Stock::where('id',$stockId)->sum('qty');

        // Get Deleted QTY
        $delQty = Entry::where('id',$id)->sum('in_qty');

        // Update Stock
        $updateStock = $latestStock - $delQty;
        // dd($updateStock);
        Entry::find($id)->delete();

        // Update Stock Table
        $stock = Stock::where('id',$stockId)->first();
        $stock->qty = $updateStock;
        $stock->updated_by = Auth::user()->id;
        $stock->save();
        toast('Data entry berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Entry::whereIn('id',$req->pilih)->delete();
        toast('Data entry berhasil dihapus','success');
        return redirect()->back();
    }
}
