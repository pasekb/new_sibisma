<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Sale;
use Carbon\Carbon;
use Auth;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale = Sale::all();
        $data = Document::all();
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        return view('page', compact('data','today','sale'));
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
        $saleId = $req->sale_id;

            $data = new Document;
            $data->sale_id = $req->sale_id;
            $data->stck = $req->stck;
            $data->stnk = $req->stnk;
            $data->bpkb = $req->bpkb;
            $data->document_note = $req->document_note;
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;
            $data->save();

            // Update Stock Table
            $sale = Sale::where('id',$saleId)->first();
            $sale->customer_name = $req->customer_name;
            $sale->phone = $req->phone;
            $sale->frame_no = $req->frame_no;
            $sale->engine_no = $req->engine_no;
            $sale->address = $req->address;
            $sale->updated_by = Auth::user()->id;
            $sale->save();

            toast('Data sale berhasil disimpan','success');
            return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        return view('page', compact('document'));
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
    public function update(Request $request, $id)
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
