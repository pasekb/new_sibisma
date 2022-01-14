<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Out;
use App\Models\BranchDelivery;
use App\Models\Manpower;
use Carbon\Carbon;
use Auth;

class BranchDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BranchDelivery::orderBy('branch_delivery_date','desc')->get();
        $manpower = Manpower::where('position','Driver')->get();
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $time = Carbon::now('GMT+8')->format('h:i:s');
        $out = Out::all();
        return view('page', compact('data','manpower','today','out','time'));
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
        $data = new BranchDelivery();
        $data->branch_delivery_date = $req->branch_delivery_date;
        $data->out_id = $req->out_id;
        $data->delivery_time = $req->delivery_time;
        $data->arrival_time = $req->arrival_time;
        $data->main_driver = $req->main_driver;
        $data->backup_driver = $req->backup_driver;
        $data->note = $req->note;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();

        toast('Data branch delivery berhasil disimpan','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BranchDelivery $branchDelivery)
    {
        return view('page', compact('branchDelivery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BranchDelivery $branchDelivery)
    {
        $manpower = Manpower::where('position','Driver')->get();
        return view('page', compact('branchDelivery','manpower'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, BranchDelivery $branchDelivery)
    {
        $data = BranchDelivery::find($branchDelivery->id);
        $data->delivery_time = $req->delivery_time;
        $data->arrival_time = $req->arrival_time;
        $data->main_driver = $req->main_driver;
        $data->backup_driver = $req->backup_driver;
        $data->note = $req->note;
        $data->updated_by = Auth::user()->id;
        $data->save();

        toast('Data branch delivery berhasil diubah','success');
        return redirect()->back();
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
        BranchDelivery::find($id)->delete();
        toast('Data branch delivery berhasil dihapus','success');
        return redirect()->back();
    }

    public function history(Request $req){
        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            $data = BranchDelivery::orderBy('branch_delivery_date','desc')->get();
            
        } else {
            $data = BranchDelivery::whereBetween('branch_delivery_date',[$req->start, $req->end])->get();
        }
        return view('page', compact('data','start','end'));
    }
}
