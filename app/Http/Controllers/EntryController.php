<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Dealer;
use App\Models\Stock;
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
        $dealer = Dealer::all();
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

        // Bukan FRAME
        $frame = Entry::where('frame_no',$req->frame_no)->count('frame_no');

        if ($frame > 0) {
            alert()->warning('Warning','Frame number already sold!');
            return redirect()->back()->with('auto', true)->withInput($req->input());
        } else {
            $data = new Entry;
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

            // Update Stock Table
            $stock = Stock::where('id',$stockId)->first();
            $stock->qty = $updateStock;
            $stock->updated_by = Auth::user()->id;
            $stock->save();

            toast('Data sale berhasil disimpan','success');
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
}
