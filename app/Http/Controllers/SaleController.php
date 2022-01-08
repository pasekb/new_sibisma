<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Leasing;
use App\Models\Stock;
use Carbon\Carbon;
use Auth;

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
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $data = Sale::where('sale_date',$today)->orderBy('id','desc')->get();

        // Total Sales
        $totalSales = Sale::where('sale_date',$today)->sum('sale_qty');
        // Ratio Percentage
        $monthSales = Sale::whereMonth('sale_date',$month)->sum('sale_qty');
        $stockQty = Stock::sum('qty');
        $ratioPercent = ($monthSales/$stockQty)*100;
        $ratioPercent = number_format($ratioPercent,0);
        $ratio = $stockQty/$monthSales;
        $ratio = number_format($ratio, 2);
        // dd($ratioPercent);
        return view('page', compact('stock','leasing','today','data','totalSales','ratioPercent','ratio'));
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
        $stock = Stock::find($req->stock_id);
        $stockQty = $stock->sum('qty');
        $calQty = $stockQty - 1;
        // dd([$stock],[$stockQty],[$calQty]);
        $data = new Sale;
        $data->sale_date = $req->sale_date;
        $data->stock_id = $req->stock_id;
        $data->nik = $req->nik;
        $data->customer_name = $req->customer_name;
        $data->phone = $req->phone;
        $data->address = $req->address;
        $data->sale_qty = 1;
        $data->frame_no = $req->frame_no;
        $data->engine_no = $req->engine_no;
        $data->leasing_id = $req->leasing_id;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();

        // Update Stok
        $stock->qty = $calQty;
        $stock->save();

        toast('Data sale berhasil disimpan','success');
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
        Sale::find($id)->delete();
        toast('Data sale berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Sale::whereIn('id',$req->pilih)->delete();
        toast('Data sale berhasil dihapus','success');
        return redirect()->back();
    }
}
