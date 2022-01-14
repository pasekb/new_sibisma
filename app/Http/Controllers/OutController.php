<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Models\Out;
use App\Models\Sale;
use App\Models\Entry;
use App\Models\Stock;
use App\Models\StockHistory;
use Carbon\Carbon;
use Auth;

class OutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = Stock::all();
        $dealer = Dealer::all();
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $data = Out::where('out_date',$today)->orderBy('id','desc')->get();

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
        if (Auth::user()->dealer_code == 'group') {
            $dealer_code = $req->dealer_code;
        } else {
            $dealer_code = Auth::user()->dealer_code;
        }

        // Get Stok ID from Input
        $stockId = $req->stock_id;

        // Get Latest Stok from Stock Table
        $latestStock = Stock::where('id',$stockId)->sum('qty');

        // Get Out QTY
        $outQty = 1;

        // Update Stock
        $updateStock = $latestStock - $outQty;

        /** ============== Create Or Update Stock History ============== */ 
        $isSale = Sale::where('sale_date',$req->out_date)->count();
        $isOut = Out::where('out_date',$req->out_date)->count();
        $isEntry = Entry::where('entry_date',$req->out_date)->count();

        // Count first stock
        $stock = Stock::sum('qty');
        $in = Entry::where('entry_date',$req->out_date)->sum('in_qty');
        $in = ($in == 0) ? $in = 0 : (int)$in ;
        $out = Out::where('out_date',$req->out_date)->sum('out_qty');
        $out = ($out == 0) ? $out = 0 : (int)$out ;
        $sale = Sale::where('sale_date',$req->out_date)->sum('sale_qty');
        $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
        $firstStock = $stock - ($in + $out + $sale);
        /** ============== END Create Or Update Stock History ============== */ 

        $frameOut = Out::where('frame_no',$req->frame_no)->count('frame_no');
        $frameSale = Sale::where('frame_no',$req->frame_no)->count('frame_no');

        if ($frameOut > 0 || $frameSale > 0) {
            alert()->warning('Warning','Frame number already out!');
            return redirect()->back()->with('auto', true)->withInput($req->input());
        } else {
            $data = new Out;
            $data->out_date = $req->out_date;
            $data->stock_id = $req->stock_id;
            $data->dealer_id = $req->dealer_id;
            $data->out_qty = 1;
            $data->frame_no = strtoupper($req->frame_no);
            $data->engine_no = $req->engine_no;
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;
            $data->save();

            // Update Stock Table
            $stock = Stock::where('id',$stockId)->first();
            $stock->qty = $updateStock;
            $stock->updated_by = Auth::user()->id;
            $stock->save();

            /** ============== END Create Or Update Stock History ============== */ 

            // Get QTY after update
            $out_qty = Out::where('out_date',$req->out_date)->sum('out_qty');
            $lastStock = Stock::sum('qty');

            if ($isEntry > 0 && $isOut > 0 && $isSale > 0) {
                // If that variables has records -> Update History
                $his = StockHistory::where('history_date',$req->out_date)->first();
                $his->in_qty = $in;
                $his->out_qty = $out_qty;
                $his->sale_qty = $sale;
                $his->last_stock = $lastStock;
                $his->updated_by = Auth::user()->id;
                $his->save();
            } elseif($isEntry > 0 || $isOut > 0 || $isSale > 0) {
                // If one of them have records -> Update History
                $his = StockHistory::where('history_date',$req->out_date)->first();
                $his->in_qty = $in;
                $his->out_qty = $out_qty;
                $his->sale_qty = $sale;
                $his->last_stock = $lastStock;
                $his->updated_by = Auth::user()->id;
                $his->save();
            } else {
                // If no record by input date in DB -> Create History
                $cek = StockHistory::where('history_date',$req->sale_date)->count();
                if ($cek > 0) {
                    // if Stock history's table contain data with the same date -> Update History
                    $his = StockHistory::where('history_date',$req->out_date)->first();
                    $his->in_qty = $in;
                    $his->out_qty = $out_qty;
                    $his->sale_qty = $sale;
                    $his->last_stock = $lastStock;
                    $his->updated_by = Auth::user()->id;
                    $his->save();
                } else {
                    // if no record by date in stock history's table -> Create History
                    $his = new StockHistory;
                    $his->history_date = $req->out_date;
                    $his->dealer_code = $dealer_code;
                    $his->first_stock = $firstStock;
                    $his->in_qty = $in;
                    $his->out_qty = $out_qty;
                    $his->sale_qty = $sale;
                    $his->last_stock = $lastStock;
                    $his->created_by = Auth::user()->id;
                    $his->updated_by = Auth::user()->id;
                    $his->save();
                }
            }
            /** ============== END Create Or Update Stock History ============== */ 

            toast('Data out berhasil disimpan','success');
            return redirect()->back()->withInput($req->except('stock_id', 'model_name','color','year_mc','on_hand','dealer_id','dealer_name','frame_no','engine_no'));
        }
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
        // Get Stock ID from Out Table
        $stockId = Out::where('id',$id)->pluck('stock_id');

        // Get Latest Stock from Stock Table
        $latestStock = Stock::where('id',$stockId)->sum('qty');

        // Get Deleted QTY
        $delQty = Out::where('id',$id)->sum('out_qty');

        // Update Stock
        $updateStock = $latestStock + $delQty;

        /** ============== Create Or Update Stock History ============== */
        $out_date = Out::where('id',$id)->pluck('out_date');
        // Count first stock
        $stock = Stock::sum('qty');
        $in = Entry::where('entry_date',$out_date)->sum('in_qty');
        $in = ($in == 0) ? $in = 0 : (int)$in ;
        $out = Out::where('out_date',$out_date)->sum('out_qty');
        $out = ($out == 0) ? $out = 0 : (int)$out ;
        $sale = Sale::where('sale_date',$out_date)->sum('sale_qty');
        $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
        /** ============== END Create Or Update Stock History ============== */ 

        // dd($updateStock);
        Out::find($id)->delete();

        // Update Stock Table
        $stock = Stock::where('id',$stockId)->first();
        $stock->qty = $updateStock;
        $stock->updated_by = Auth::user()->id;
        $stock->save();

        /** ============== END Create Or Update Stock History ============== */ 

        // Get QTY after update
        $out_qty = Out::where('out_date',$out_date)->sum('out_qty');
        $out_qty = ($out_qty == 0) ? $out_qty = 0 : (int)$out_qty ;
        $lastStock = Stock::sum('qty');

        // Update Stock History
        $his = StockHistory::where('history_date',$out_date)->first();
        $his->in_qty = $in;
        $his->out_qty = $out_qty;
        $his->sale_qty = $sale;
        $his->last_stock = $lastStock;
        $his->updated_by = Auth::user()->id;
        $his->save();
        /** ============== END Create Or Update Stock History ============== */

        toast('Data Out berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Out::whereIn('id',$req->pilih)->delete();
        toast('Data Out berhasil dihapus','success');
        return redirect()->back();
    }

    public function history(Request $req){
        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            $data = Out::orderBy('out_date','desc')->get();
            
        } else {
            $data = Out::whereBetween('out_date',[$req->start, $req->end])->get();
        }
        return view('page', compact('data','start','end'));
    }
}
