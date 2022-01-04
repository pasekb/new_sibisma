<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manpower;
use App\Models\Dealer;
use Auth;

class ManpowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Manpower::all();
        $dealer = Dealer::all();
        return view('manpower', compact('data','dealer'));
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
        $data = new Manpower;
        $data->dealer_id = $req->dealer_id;
        $data->name = $req->name;
        $data->address = $req->address;
        $data->phone = $req->phone;
        $data->birthday = $req->birthday;
        $data->gender = $req->gender;
        $data->join_date = $req->join_date;
        $data->position = $req->position;
        $data->years_of_service = $req->yos;
        $data->education = $req->education;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();
        toast('Data manpower berhasil disimpan','success');
        return redirect()->route('manpower.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Manpower $manpower)
    {
        return view('manpower', compact('manpower'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Manpower $manpower)
    {
        $dealer = Dealer::all();
        return view('manpower', compact('manpower','dealer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Manpower $manpower)
    {
        Manpower::where('id',$manpower->id)->update([
            'dealer_id' => $req->dealer_id,
            'name' => $req->name,
            'address' => $req->address,
            'phone' => $req->phone,
            'birthday' => $req->birthday,
            'gender' => $req->gender,
            'join_date' => $req->join_date,
            'position' => $req->position,
            'years_of_service' => $req->yos,
            'education' => $req->education,
            'updated_by' => Auth::user()->id,
        ]);
        toast('Data manpower berhasil diubah','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manpower $manpower)
    {
        //
    }

    public function delete($id){
        Manpower::find($id)->delete();
        toast('Data manpower terhapus','success');
        return redirect()->back();
    }
}
