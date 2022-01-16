<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Sale;
use App\Models\Out;
use App\Models\Leasing;
use App\Models\Stock;
use App\Models\Document;
use App\Models\StockHistory;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = Stock::all();
        $leasing = Leasing::all();
        $dealer = Dealer::all();
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $data = Sale::where('sale_date',$today)->orderBy('id','desc')->get();

        return view('page', compact('stock','leasing','today','data','dealer'));
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

        // Get Sold QTY
        $soldQty = 1;

        // Update Stock
        $updateStock = $latestStock - $soldQty;

        /** ============== Create Or Update Stock History ============== */ 
        $isSale = Sale::where('sale_date',$req->sale_date)->count();
        $isOut = Out::where('out_date',$req->sale_date)->count();
        $isEntry = Entry::where('entry_date',$req->sale_date)->count();

        // Count first stock
        $stock = Stock::sum('qty');
        $in = Entry::where('entry_date',$req->sale_date)->sum('in_qty');
        $in = ($in == 0) ? $in = 0 : (int)$in ;
        $out = Out::where('out_date',$req->sale_date)->sum('out_qty');
        $out = ($out == 0) ? $out = 0 : (int)$out ;
        $sale = Sale::where('sale_date',$req->sale_date)->sum('sale_qty');
        $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
        $firstStock = $stock - ($in + $out + $sale);
        /** ============== END Create Or Update Stock History ============== */ 

        $frameSale = Sale::where('frame_no',$req->frame_no)->count('frame_no');
        $frameOut = Out::where('frame_no',$req->frame_no)->count('frame_no');

        if ($frameSale > 0 || $frameOut > 0) {
            alert()->warning('Warning','Frame number already sold!');
            return redirect()->back()->with('auto', true)->withInput($req->input());
        } else {
            $data = new Sale;
            $data->sale_date = $req->sale_date;
            $data->stock_id = $req->stock_id;
            $data->nik = $req->nik;
            $data->customer_name = $req->customer_name;
            $data->phone = $req->phone;
            $data->address = $req->address;
            $data->sale_qty = 1;
            $data->frame_no = strtoupper($req->frame_no);
            $data->engine_no = $req->engine_no;
            $data->leasing_id = $req->leasing_id;
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;
            $data->save();

            // Update Stock Table
            $stock = Stock::where('id',$stockId)->first();
            $stock->qty = $updateStock;
            $stock->updated_by = Auth::user()->id;
            $stock->save();
            
            /** ============== Create Documents ============== */ 
            $cekframe = Sale::where('frame_no',$req->frame_no)->count('frame_no');

            if($cekframe > 0){

                $saleId = Sale::where('frame_no',$req->frame_no)->sum('id');

                $data = new Document;
                $data->sale_id = $saleId;
                $data->stck = $req->stck;
                $data->stnk = $req->stnk;
                $data->bpkb = $req->bpkb;
                $data->document_note = $req->document_note;
                $data->created_by = Auth::user()->id;
                $data->updated_by = Auth::user()->id;
                $data->save();
            }
            /** ============== END Create Documents ============== */ 
            
            /** ============== Create Or Update Stock History ============== */ 

            // Get QTY after update
            $sale_qty = Sale::where('sale_date',$req->sale_date)->sum('sale_qty');
            $lastStock = Stock::sum('qty');

            if ($isEntry > 0 && $isOut > 0 && $isSale > 0) {
                // If that variables has records -> Update History
                $his = StockHistory::where('history_date',$req->sale_date)->first();
                $his->in_qty = $in;
                $his->out_qty = $out;
                $his->sale_qty = $sale_qty;
                $his->last_stock = $lastStock;
                $his->updated_by = Auth::user()->id;
                $his->save();
            } elseif($isEntry > 0 || $isOut > 0 || $isSale > 0) {
                // If one of them have records -> Update History
                $his = StockHistory::where('history_date',$req->sale_date)->first();
                $his->in_qty = $in;
                $his->out_qty = $out;
                $his->sale_qty = $sale_qty;
                $his->last_stock = $lastStock;
                $his->updated_by = Auth::user()->id;
                $his->save();
            } else {
                // If no record by input date in DB -> Create History
                $cek = StockHistory::where('history_date',$req->sale_date)->count();
                if ($cek > 0) {
                    // if Stock history's table contain data with the same date -> Update History
                    $his = StockHistory::where('history_date',$req->sale_date)->first();
                    $his->in_qty = $in;
                    $his->out_qty = $out;
                    $his->sale_qty = $sale_qty;
                    $his->last_stock = $lastStock;
                    $his->updated_by = Auth::user()->id;
                    $his->save();
                } else {
                    // if no record by date in stock history's table -> Create History
                    $his = new StockHistory;
                    $his->history_date = $req->sale_date;
                    $his->id_key = Carbon::now('GMT+8')->format('H').'sh'.$dealer_code.Carbon::now('GMT+8')->format('Y').Carbon::now('GMT+8')->format('i').Carbon::now('GMT+8')->format('m').'b'.Carbon::now('GMT+8')->format('d').Carbon::now('GMT+8')->format('s');
                    $his->dealer_code = $dealer_code;
                    $his->first_stock = $firstStock;
                    $his->in_qty = $in;
                    $his->out_qty = $out;
                    $his->sale_qty = $sale_qty;
                    $his->last_stock = $lastStock;
                    $his->created_by = Auth::user()->id;
                    $his->updated_by = Auth::user()->id;
                    $his->save();
                }
            }
            /** ============== END Create Or Update Stock History ============== */ 
        
            toast('Data sale berhasil disimpan','success');
            return redirect()->back()->withInput($req->except('stock_id', 'model_name','color','year_mc','on_hand','leasing_id','leasing_code','frame_no','engine_no','nik','customer_name','phone','address'));
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
        // Get Stock ID from Sale Table
        $stockId = Sale::where('id',$id)->pluck('stock_id');

        // Get Latest Stock from Stock Table
        $latestStock = Stock::where('id',$stockId)->sum('qty');

        // Get Deleted QTY
        $delQty = Sale::where('id',$id)->sum('sale_qty');

        // Update Stock
        $updateStock = $latestStock + $delQty;

        /** ============== Create Or Update Stock History ============== */
        $sale_date = Sale::where('id',$id)->pluck('sale_date');
        // Count first stock
        $stock = Stock::sum('qty');
        $in = Entry::where('entry_date',$sale_date)->sum('in_qty');
        $in = ($in == 0) ? $in = 0 : (int)$in ;
        $out = Out::where('out_date',$sale_date)->sum('out_qty');
        $out = ($out == 0) ? $out = 0 : (int)$out ;
        $sale = Sale::where('sale_date',$sale_date)->sum('sale_qty');
        $sale = ($sale == 0) ? $sale = 0 : (int)$sale ;
        /** ============== END Create Or Update Stock History ============== */ 

        // dd($updateStock);
        Sale::find($id)->delete();

        // Update Stock Table
        $stock = Stock::where('id',$stockId)->first();
        $stock->qty = $updateStock;
        $stock->updated_by = Auth::user()->id;
        $stock->save();

        /** ============== END Create Or Update Stock History ============== */ 

        // Get QTY after update
        $sale_qty = Sale::where('sale_date',$sale_date)->sum('sale_qty');
        $sale_qty = ($sale_qty == 0) ? $sale_qty = 0 : (int)$sale_qty ;
        $lastStock = Stock::sum('qty');

        // Update Stock History
        $his = StockHistory::where('history_date',$sale_date)->first();
        $his->in_qty = $in;
        $his->out_qty = $out;
        $his->sale_qty = $sale_qty;
        $his->last_stock = $lastStock;
        $his->updated_by = Auth::user()->id;
        $his->save();
        /** ============== END Create Or Update Stock History ============== */

        // Delete Document by Sale ID
        // Get document ID by Sale ID
        $docId = Document::where('sale_id',$id)->pluck('id');
        Document::where('id',$docId)->delete();
        
        toast('Data sale berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Sale::whereIn('id',$req->pilih)->delete();
        toast('Data sale berhasil dihapus','success');
        return redirect()->back();
    }

    public function history(Request $req){
        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            $data = Sale::orderBy('sale_date','desc')->get();
            
        } else {
            $data = Sale::whereBetween('sale_date',[$req->start, $req->end])->get();
        }
        return view('page', compact('data','start','end'));
    }

    public function achievment($param){
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');
        $tgl = Carbon::now('GMT+8');
        $lastMonth = $tgl->subMonth()->format('Y-m');
        $lastYear = $year - 1;

        if ($param == 'lm') {
            $last = Sale::whereMonth('sale_date', $lastMonth);
            $data = Sale::whereMonth('sale_date', $month)->union($last)->get();
        } else {
            $last = Sale::whereYear('sale_date', $lastYear);
            $data = Sale::whereMonth('sale_date', $year)->union($last)->get();
        }
        dd($data);
        return view('page', compact('data','param'));
        
    }
}
