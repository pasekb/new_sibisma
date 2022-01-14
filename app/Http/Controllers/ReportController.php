<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockHistory;

class ReportController extends Controller
{
    public function stockHistory(){
        $data = StockHistory::all();
        return view('page', compact('data'));
    }

    public function changeStatusStockHistory($id, $status){
        $data = StockHistory::where('id',$id)->first();
        if ($status == 'uncompleted') {
            $data->status = 'completed';
        } else {
            $data->status = 'uncompleted';
        }
        
        $data->save();
        toast('Status berhasil diubah','success');
        return redirect()->back();
    }

    public function reportPrint($param, $start, $end){
        if ($param == 'entry') {
            
        } else {
            # code...
        }
        
    }
}
