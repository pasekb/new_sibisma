<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Models\Out;
use App\Models\Sale;
use App\Models\Stock;
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
        // Get Stok ID from Input
        $stockId = $req->stock_id;

        // Get Latest Stok from Stock Table
        $latestStock = Stock::where('id',$stockId)->sum('qty');

        // Get Out QTY
        $outQty = 1;

        // Update Stock
        $updateStock = $latestStock - $outQty;

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

            toast('Data out berhasil disimpan','success');
            return redirect()->back();
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
        // dd($updateStock);
        Out::find($id)->delete();

        // Update Stock Table
        $stock = Stock::where('id',$stockId)->first();
        $stock->qty = $updateStock;
        $stock->updated_by = Auth::user()->id;
        $stock->save();
        toast('Data Out berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Out::whereIn('id',$req->pilih)->delete();
        toast('Data Out berhasil dihapus','success');
        return redirect()->back();
    }
}
