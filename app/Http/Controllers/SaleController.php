<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Leasing;
use App\Models\Stock;
use Carbon\Carbon;

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
        $data = Sale::where('sale_date',$today)->orderBy('sale_date','desc')->get();
        return view('page', compact('stock','leasing','today','data'));
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
        $data = new Sale;
        $data->sale_date = $req->sale_date;
        $data->stock_id = $req->stock_id;
        $data->nik = $req->nik;
        $data->customer_name = $req->customer_name;
        $data->phone = $req->phone;
        $data->address = $req->address;
        $data->sale_qty = 1;
        $data->frame_no = $req->frame_no;
        $data->engine = $req->engine_no;
        $data->leasing_id = $req->nono;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();
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
