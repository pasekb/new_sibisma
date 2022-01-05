<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dealer;
use Auth;

class DealerController extends Controller
{
    public function index(){
        $data = Dealer::orderBy('dealers.dealer_code','asc')->get();
        return view('dealer', compact('data'));
    }

    public function store(Request $req){
        $cek = Dealer::where('dealer_code', $req->dealer_code)->count();
        if ($cek > 0) {
            return redirect()->back()->withInput()->with('message','Kode dealer sudah ada!');
        } else {
            $data = new Dealer;
            $data->dealer_code  = $req->dealer_code;
            $data->dealer_name  = $req->dealer_name;
            $data->phone  = $req->phone;
            $data->address  = $req->address;
            $data->created_by = Auth::user()->id;
            $data->updated_by = Auth::user()->id;
            $data->save();
            toast('Data dealer berhasil disimpan','success');
            return redirect()->route('dealer');
        }
    }

    public function edit($id){
        $data = Dealer::where('id',$id)->get();
        return view('dealer', compact('data'));
    }

    public function update(Request $req){
        Dealer::find($req->id)->update([
            'dealer_name' => $req->dealer_name,
            'phone' => $req->phone,
            'address' => $req->address,
            'updated_by' => Auth::user()->id,
        ]);
        toast('Data dealer berhasil diubah','success');
        return redirect()->back();
    }

    public function delete($id){
        Dealer::find($id)->delete();
        toast('Data dealer terhapus','success');
        return redirect()->back();
    }
}
