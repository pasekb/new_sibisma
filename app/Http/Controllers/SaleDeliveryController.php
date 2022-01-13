<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDelivery;
use App\Models\Manpower;
use Carbon\Carbon;
use Auth;

class SaleDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SaleDelivery::orderBy('sale_delivery_date','desc')->get();
        $manpower = Manpower::where('position','Driver')->get();
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $time = Carbon::now('GMT+8')->format('h:i:s');
        $sale = Sale::all();
        return view('page', compact('data','manpower','today','sale','time'));
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
        $data = new SaleDelivery;
        $data->sale_delivery_date = $req->sale_delivery_date;
        $data->sale_id = $req->sale_id;
        $data->delivery_time = $req->delivery_time;
        $data->arrival_time = $req->arrival_time;
        $data->main_driver = $req->main_driver;
        $data->backup_driver = $req->backup_driver;
        $data->note = $req->note;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();

        toast('Data sale delivery berhasil disimpan','success');
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
}
