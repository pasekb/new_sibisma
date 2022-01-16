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
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        if ($date == null) {
            // Stock Report
            $date = $today;
            $firstStock = StockHistory::where('history_date',$today)->sum('first_stock');
            $inYIMM = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->where('entry_date',$today)
            ->where('dealer_code','YIMM')->sum('in_qty');
            $inBranch = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->where('entry_date',$today)
            ->where('dealer_code','!=','YIMM')->sum('in_qty');
            $out = Out::where('out_date',$today)->sum('out_qty');
            $sale = Sale::where('sale_date',$today)->sum('sale_qty');
            $lastStock = Stock::sum('qty');

            $dataInYIMM = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->where('entry_date',$today)
            ->where('dealer_code','YIMM')->get();
            $dataInBranch = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->where('entry_date',$today)
            ->where('dealer_code','!=','YIMM')->get();
            $dataOut = Out::join('dealers','outs.dealer_id','=','dealers.id')
            ->selectRaw('SUM(out_qty) as qty, dealer_name ,stock_id')
            ->where('out_date',$today)
            ->groupBy('dealer_id','stock_id')->get();
            $dataSale = Sale::join('leasings','sales.leasing_id','=','leasings.id')
            ->selectRaw('SUM(sale_qty) as qty ,stock_id, leasing_id')
            ->where('sale_date',$today)
            ->groupBy('stock_id','leasing_id')->get();

            $idKey = StockHistory::where('history_date',$today)->pluck('id_key');
            $reportId = $idKey[0];
        }else {
            // Stock Report by date
            $firstStock = StockHistory::where('history_date',$date)->sum('first_stock');
            $inYIMM = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->where('entry_date',$date)
            ->where('dealer_code','YIMM')->sum('in_qty');
            $inBranch = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->where('entry_date',$date)
            ->where('dealer_code','!=','YIMM')->sum('in_qty');
            $out = Out::where('out_date',$date)->sum('out_qty');
            $sale = Sale::where('sale_date',$date)->sum('sale_qty');
            $lastStock = StockHistory::where('history_date',$date)->sum('last_stock');

            $dataInYIMM = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->where('entry_date',$date)
            ->where('dealer_code','YIMM')->get();
            $dataInBranch = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->where('entry_date',$date)
            ->where('dealer_code','!=','YIMM')->get();
            $dataOut = Out::join('dealers','outs.dealer_id','=','dealers.id')
            ->selectRaw('SUM(out_qty) as qty, dealer_name ,stock_id')
            ->where('out_date',$date)
            ->groupBy('dealer_id','stock_id')->get();
            $dataSale = Sale::join('leasings','sales.leasing_id','=','leasings.id')
            ->selectRaw('SUM(sale_qty) as qty ,stock_id, leasing_id')
            ->where('sale_date',$date)
            ->groupBy('stock_id','leasing_id')->get();

            $idKey = StockHistory::where('history_date',$date)->pluck('id_key');
            $reportId = $idKey[0];
        }
        
        // Data Report History

        $data = StockHistory::orderBy('history_date','desc')->limit(7)->get();
        return view('page', compact('data','date','today','firstStock','inYIMM','out','sale','dataInYIMM','dataOut','dataSale','data','dataInBranch','inBranch','lastStock','reportId'));
    }
}
