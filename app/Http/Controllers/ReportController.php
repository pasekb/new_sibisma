<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockHistory;
use App\Exports\ReportExport;
use App\Models\Entry;
use App\Models\Out;
use App\Models\Sale;
use App\Models\Stock;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function stockHistory(Request $req){
        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            $data = StockHistory::orderBy('history_date','desc')->get();
        }else {
            $data = StockHistory::whereBetween('history_date',[$req->start, $req->end])->orderBy('history_date','asc')->get();
        }
        
        return view('page', compact('data','start','end'));
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
            return (new ReportExport)->param($param)->start($start)->end($end)->download('Entry_report_'.$start.'-'.$end.'.xlsx');
        }elseif($param == 'sale') {
            return (new ReportExport)->param($param)->start($start)->end($end)->download('Sale_report_'.$start.'-'.$end.'.xlsx');
        }elseif($param == 'out') {
            return (new ReportExport)->param($param)->start($start)->end($end)->download('Out_report_'.$start.'-'.$end.'.xlsx');
        }elseif($param == 'sale-delivery') {
            return (new ReportExport)->param($param)->start($start)->end($end)->download('Sale_delivery_report_'.$start.'-'.$end.'.xlsx');
        }elseif($param == 'branch-delivery') {
            return (new ReportExport)->param($param)->start($start)->end($end)->download('Branch_delivery_report_'.$start.'-'.$end.'.xlsx');
        }elseif($param == 'stock-history') {
            return (new ReportExport)->param($param)->start($start)->end($end)->download('Stock_history_report_'.$start.'-'.$end.'.xlsx');
        }elseif($param == 'document') {
            return (new ReportExport)->param($param)->start($start)->end($end)->download('Document_report_'.$start.'-'.$end.'.xlsx');
        }else{
            return (new ReportExport)->param($param)->start($start)->end($end)->download('Error_report_'.$start.'-'.$end.'.xlsx');
        }
    }

    public function sendReport(Request $req){
        $date = $req->date;
        if ($date == null) {
            $today = Carbon::now('GMT+8')->format('Y-m-d');
            $firstStock = StockHistory::where('history_date',$today)->pluck('first_stock');
            $in = Entry::where('entry_date',$today)->sum('in_qty');
            $out = Out::where('out_date',$today)->sum('out_qty');
            $sale = Sale::where('sale_date',$today)->sum('sale_qty');
            $lastStock = Stock::sum('qty');

            $dataIn = Entry::where('entry_date',$today)->get();
            $dataOut = Out::where('out_date',$today)->get();
            $dataSale = Sale::where('sale_date',$today)->get();
        }else {
            $firstStock = StockHistory::where('history_date',$date)->pluck('first_stock');
            $in = Entry::where('entry_date',$date)->sum('in_qty');
            $out = Out::where('out_date',$date)->sum('out_qty');
            $sale = Sale::where('sale_date',$date)->sum('sale_qty');
            $lastStock = Stock::sum('qty');

            $dataIn = Entry::where('entry_date',$date)->get();
            $dataOut = Out::where('out_date',$date)->get();
            $dataSale = Sale::where('sale_date',$date)->get();
        }
        
        $data = StockHistory::orderBy('history_date','desc')->limit(7)->get();
        return view('page', compact('data','date','today','firstStock','in','out','sale','dataIn','dataOut','dataSale','data'));
    }
}
