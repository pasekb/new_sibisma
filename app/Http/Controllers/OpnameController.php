<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Opname;
use App\Models\Stock;
use App\Models\Dealer;
use App\Models\Log;
use Carbon\Carbon;
use Auth;

class OpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        if ($dc == 'group') {
            $stock = Stock::all();
            $data = Opname::where('opname_date',$today)->orderBy('id','desc')->get();
        }else{
            $stock = Stock::where('dealer_id',$did)->get();
            $data = Opname::join('stocks','opnames.stock_id','stocks.id')
            ->where('stocks.dealer_id',$did)
            ->where('opname_date',$today)->orderBy('opnames.id','desc')->get();
        }
        return view('page', compact('stock','today','data'));
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
        $qty = $req->on_hand;
        $opname = $req->stock_opname;

        if ($qty > $opname) {
            $diff = $qty - $opname;
        } else {
            $diff = $opname - $qty;
        }
        
        $data = new Opname;
        $data->opname_date = $req->opname_date;
        $data->stock_id = $req->stock_id;
        $data->stock_system = $req->on_hand;
        $data->stock_opname = $req->stock_opname;
        $data->difference = $diff;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();

        $stock = Stock::where('id', $req->stock_id)->first();
        $stock->qty = $req->stock_opname;
        $stock->save();

        // Write log
        $log = new Log;
        $log->log_date = Carbon::now('GMT+8')->format('Y-m-d');
        $log->activity = 'creates stock opname data';
        $log->user_id = Auth::user()->id;
        $log->save();

        toast('Data stock opname berhasil disimpan','success');
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

    public function history(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = Opname::orderBy('id','desc')->get();
            }else{
                $data = Opname::join('stocks','opnames.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->orderBy('opnames.id','desc')->get();
            }
            
        } else {
            if ($dc == 'group') {
                $data = Opname::whereBetween('opname_date',[$req->start, $req->end])->orderBy('id','desc')->get();
            }else{
                $data = Opname::join('stocks','opnames.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->whereBetween('opname_date',[$req->start, $req->end])->orderBy('opnames.id','desc')->get();
            }
        }
        return view('page', compact('data','start','end'));
    }
}
