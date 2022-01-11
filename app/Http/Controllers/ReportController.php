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
        $data->status = $status;
        $data->save();
        toast('Status berhasil diubah','success');
        return redirect()->back();
    }

    public function delete($id){
        // Get Stock ID from Entry Table
        $stockId = Entry::where('id',$id)->pluck('stock_id');

        // Get Latest Stock from Stock Table
        $latestStock = Stock::where('id',$stockId)->sum('qty');

        // Get Deleted QTY
        $delQty = Entry::where('id',$id)->sum('in_qty');

        // Update Stock
        $updateStock = $latestStock - $delQty;
        // dd($updateStock);
        Entry::find($id)->delete();

        // Update Stock Table
        $stock = Stock::where('id',$stockId)->first();
        $stock->qty = $updateStock;
        $stock->updated_by = Auth::user()->id;
        $stock->save();
        toast('Data history berhasil dihapus','success');
        return redirect()->back();
    }
}
