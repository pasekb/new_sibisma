<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dealer;
use App\Models\Stock;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dealer = Dealer::all();
        $unit = Unit::all();
        $data = Stock::all();
        return view('page', compact('data','dealer','unit'));
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
        $data = new Stock;
        $data->unit_id = $req->unit_id;
        $data->dealer_id = $req->dealer_id;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        if ($req->qty == '') {
            $data->qty = 0;
        } else {
            $data->qty = $req->qty;
        }
        $data->save();
        toast('Data stock berhasil disimpan','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        return view('page', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
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
    public function update(Request $request, Stock $stock)
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
        Stock::find($id)->delete();
        toast('Data stock berhasil dihapus','success');
        return redirect()->back();
    }

    public function deleteall(Request $req){
        Stock::whereIn('id',$req->pilih)->delete();
        toast('Data stock berhasil dihapus','success');
        return redirect()->back();
    }
}
