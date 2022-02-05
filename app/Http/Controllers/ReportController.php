<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockHistory;
use App\Exports\ReportExport;
use App\Models\Entry;
use App\Models\Dealer;
use App\Models\Out;
use App\Models\Sale;
use App\Models\Opname;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function stockHistory(Request $req){
        $dc = Auth::user()->dealer_code;

        $start = $req->start;
        $end = $req->end;
        if ($start == null && $end == null) {
            if ($dc == 'group') {
                $data = StockHistory::orderBy('history_date','desc')->get();
            } else {
                $data = StockHistory::where('dealer_code',$dc)->orderBy('history_date','desc')->get();
            }
            
        }else {
            if ($dc == 'group') {
                $data = StockHistory::whereBetween('history_date',[$req->start, $req->end])->orderBy('history_date','asc')->get();
            }else{
                $data = StockHistory::whereBetween('history_date',[$req->start, $req->end])
                ->where('dealer_code',$dc)->orderBy('history_date','asc')->get();
            }
            
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
        }elseif($param == 'log') {
            return (new ReportExport)->param($param)->start($start)->end($end)->download('Log_report_'.$start.'-'.$end.'.xlsx');
        }elseif($param == 'opname') {
            return (new ReportExport)->param($param)->start($start)->end($end)->download('Opname_report_'.$start.'-'.$end.'.xlsx');
        }else{
            return (new ReportExport)->param($param)->start($start)->end($end)->download('Error_report_'.$start.'-'.$end.'.xlsx');
        }
    }

    public function sendReport(Request $req){
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        // dd($dealerName[0]);

        $date = $req->date;
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        $fns = StockHistory::where('history_date',$today)
        ->where('dealer_code',$dc)
        ->first();

        if ($fns == null) {
            $fns = StockHistory::where('dealer_code',$dc)
            ->orderBy('history_date','desc')
            ->first();

            $faktur = StockHistory::where('dealer_code',$dc)
            ->orderBy('history_date', 'desc')
            ->pluck('faktur');

            $service = StockHistory::where('dealer_code',$dc)
            ->orderBy('history_date', 'desc')
            ->pluck('service');

            $faktur = $faktur[0];
            $service = $service[0];
        }else{
            $faktur = StockHistory::where('history_date',$today)
            ->where('dealer_code',$dc)
            ->orderBy('history_date', 'desc')
            ->sum('faktur');

            $service = StockHistory::where('history_date',$today)
            ->where('dealer_code',$dc)
            ->orderBy('history_date', 'desc')
            ->sum('service');
        }
        

        if ($date == null) {
                // Stock Report
                $firstStock = StockHistory::where('history_date',$today)
                ->where('dealer_code',$dc)->sum('first_stock');
                
                $inYIMM = Entry::join('dealers','entries.dealer_id','=','dealers.id')
                ->join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$today)
                ->where('dealer_code','YIMM')
                ->where('stocks.dealer_id',$did)->sum('in_qty');

                $inBranch = Entry::join('dealers','entries.dealer_id','=','dealers.id')
                ->join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$today)
                ->where('dealer_code','!=','YIMM')
                ->where('stocks.dealer_id',$did)->sum('in_qty');
                
                $out = Out::join('stocks','outs.stock_id','stocks.id')
                ->where('out_date',$today)
                ->where('stocks.dealer_id',$did)->sum('out_qty');
                
                $sale = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('sale_date',$today)
                ->where('stocks.dealer_id',$did)->sum('sale_qty');
                
                $lastStock = StockHistory::where('history_date',$today)
                ->where('dealer_code',$dc)->sum('last_stock');
                
                $dataInYIMM = Entry::join('dealers','entries.dealer_id','=','dealers.id')
                ->join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$today)
                ->where('dealer_code','YIMM')
                ->where('stocks.dealer_id',$did)->get();
                
                $dataInBranch = Entry::join('dealers','entries.dealer_id','=','dealers.id')
                ->join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$today)
                ->where('dealer_code','!=','YIMM')
                ->where('stocks.dealer_id',$did)->get();
                
                $dataOut = Out::join('dealers','outs.dealer_id','=','dealers.id')
                ->join('stocks','outs.stock_id','stocks.id')
                ->selectRaw('SUM(out_qty) as qty, dealer_name ,stock_id')
                ->where('out_date',$today)
                ->where('stocks.dealer_id',$did)
                ->groupBy('dealers.id','stock_id')->get();
                
                if(Auth::user()->crud == 'simple')
                    $dataSale = Sale::join('stocks','sales.stock_id','stocks.id')
                    ->selectRaw('SUM(sale_qty) as qty ,stock_id')
                    ->where('sale_date',$today)
                    ->where('stocks.dealer_id',$did)->get();
                else{
                    $dataSale = Sale::join('leasings','sales.leasing_id','=','leasings.id')
                    ->join('stocks','sales.stock_id','stocks.id')
                    ->selectRaw('SUM(sale_qty) as qty ,stock_id, leasing_id')
                    ->where('sale_date',$today)
                    ->where('stocks.dealer_id',$did)
                    ->groupBy('stock_id','leasing_id')->get();
                }

                $dataFaktur = StockHistory::where('history_date',$today)
                ->where('dealer_code',$dc)
                ->orderBy('history_date', 'desc')
                ->sum('faktur');

                $dataService = StockHistory::where('history_date',$today)
                ->where('dealer_code',$dc)
                ->orderBy('history_date', 'desc')
                ->sum('service');
                
                $isIdKey = StockHistory::where('history_date',$today)
                    ->where('dealer_code',$dc)->count('id_key');
                if ($isIdKey > 0) {
                    $idKey = StockHistory::where('history_date',$today)
                    ->where('dealer_code',$dc)->pluck('id_key');
                    $reportId = $idKey[0];
                } else {
                    $reportId = null;
                }

                $stockOpname = Opname::join('stocks','opnames.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->where('opname_date',$today)->sum('stock_opname');

                $dateOpname = $today;

                $dealerName = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
                $dealerName = $dealerName[0];
            
        }else { //if contain date
            
                // Stock Report
                $firstStock = StockHistory::where('history_date',$date)
                ->where('dealer_code',$dc)->sum('first_stock');
                $inYIMM = Entry::join('dealers','entries.dealer_id','=','dealers.id')
                ->join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$date)
                ->where('dealer_code','YIMM')
                ->where('stocks.dealer_id',$did)->sum('in_qty');
                $inBranch = Entry::join('dealers','entries.dealer_id','=','dealers.id')
                ->join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$date)
                ->where('dealer_code','!=','YIMM')
                ->where('stocks.dealer_id',$did)->sum('in_qty');
                $out = Out::join('stocks','outs.stock_id','stocks.id')
                ->where('out_date',$date)
                ->where('stocks.dealer_id',$did)->sum('out_qty');
                $sale = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('sale_date',$date)
                ->where('stocks.dealer_id',$did)->sum('sale_qty');
                $lastStock = StockHistory::where('history_date',$date)
                ->where('dealer_code',$dc)->sum('last_stock');

                $dataInYIMM = Entry::join('dealers','entries.dealer_id','=','dealers.id')
                ->join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$date)
                ->where('dealer_code','YIMM')
                ->where('stocks.dealer_id',$did)->get();
                $dataInBranch = Entry::join('dealers','entries.dealer_id','=','dealers.id')
                ->join('stocks','entries.stock_id','stocks.id')
                ->where('entry_date',$date)
                ->where('dealer_code','!=','YIMM')
                ->where('stocks.dealer_id',$did)->get();
                $dataOut = Out::join('dealers','outs.dealer_id','=','dealers.id')
                ->join('stocks','outs.stock_id','stocks.id')
                ->selectRaw('SUM(out_qty) as qty, dealer_name ,stock_id')
                ->where('out_date',$date)
                ->where('stocks.dealer_id',$did)
                ->groupBy('dealers.id','stock_id')->get();

                if(Auth::user()->crud == 'simple')
                    $dataSale = Sale::join('stocks','sales.stock_id','stocks.id')
                    ->selectRaw('SUM(sale_qty) as qty ,stock_id')
                    ->where('sale_date',$date)
                    ->where('stocks.dealer_id',$did)->get();
                else{
                    $dataSale = Sale::join('leasings','sales.leasing_id','=','leasings.id')
                    ->join('stocks','sales.stock_id','stocks.id')
                    ->selectRaw('SUM(sale_qty) as qty ,stock_id, leasing_id')
                    ->where('sale_date',$date)
                    ->where('stocks.dealer_id',$did)
                    ->groupBy('stock_id','leasing_id')->get();
                }

                $dataFaktur = StockHistory::where('history_date',$date)
                ->where('dealer_code',$dc)
                ->orderBy('history_date', 'desc')
                ->sum('faktur');

                $dataService = StockHistory::where('history_date',$date)
                ->where('dealer_code',$dc)
                ->orderBy('history_date', 'desc')
                ->sum('service');

                $isIdKey = StockHistory::where('history_date',$date)
                ->where('dealer_code',$dc)->count('id_key');
                if ($isIdKey > 0) {
                    $idKey = StockHistory::where('history_date',$date)
                    ->where('dealer_code',$dc)->pluck('id_key');
                    $reportId = $idKey[0];
                } else {
                    $reportId = null;
                }

                $stockOpname = Opname::join('stocks','opnames.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->where('opname_date',$date)->sum('stock_opname');

                $dateOpname = $date;

                $dealerName = Dealer::where('dealer_code',$dc)->pluck('dealer_name');
                $dealerName = $dealerName[0];
        }
        
        // Data Report History
            $data = StockHistory::where('dealer_code',$dc)->orderBy('history_date','desc')->limit(7)->get();

            return view('page', compact('data','date','today','firstStock','inYIMM','out','sale','dataInYIMM','dataOut','dataSale','dataInBranch','inBranch','lastStock','reportId','dealerName','dateOpname','stockOpname','faktur','service','fns','dataFaktur','dataService'));
        
    }

    public function sendReportGroup($dealer, $date){
        $start = null;
        $end = null;
        if($dealer == 'group' && $date == 'all'){
            $data = StockHistory::orderBy('history_date','desc')->limit(31)->get();
            return view('component.stock-history-group', compact('data','start','end'));
        }else{
            // Stock Report
            $did = Dealer::where('dealer_code',$dealer)->sum('id');

            $firstStock = StockHistory::where('history_date',$date)
            ->where('dealer_code',$dealer)->sum('first_stock');
            $inYIMM = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$date)
            ->where('dealer_code','YIMM')
            ->where('stocks.dealer_id',$did)->sum('in_qty');
            $inBranch = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$date)
            ->where('dealer_code','!=','YIMM')
            ->where('stocks.dealer_id',$did)->sum('in_qty');
            $out = Out::join('stocks','outs.stock_id','stocks.id')
            ->where('out_date',$date)
            ->where('stocks.dealer_id',$did)->sum('out_qty');
            $sale = Sale::join('stocks','sales.stock_id','stocks.id')
            ->where('sale_date',$date)
            ->where('stocks.dealer_id',$did)->sum('sale_qty');
            $lastStock = StockHistory::where('history_date',$date)
            ->where('dealer_code',$dealer)->sum('last_stock');

            $dataInYIMM = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$date)
            ->where('dealer_code','YIMM')
            ->where('stocks.dealer_id',$did)->get();
            $dataInBranch = Entry::join('dealers','entries.dealer_id','=','dealers.id')
            ->join('stocks','entries.stock_id','stocks.id')
            ->where('entry_date',$date)
            ->where('dealer_code','!=','YIMM')
            ->where('stocks.dealer_id',$did)->get();
            $dataOut = Out::join('dealers','outs.dealer_id','=','dealers.id')
            ->join('stocks','outs.stock_id','stocks.id')
            ->selectRaw('SUM(out_qty) as qty, dealer_name ,stock_id')
            ->where('out_date',$date)
            ->where('stocks.dealer_id',$did)
            ->groupBy('dealers.id','stock_id')->get();

            if(Auth::user()->crud == 'simple')
                $dataSale = Sale::join('stocks','sales.stock_id','stocks.id')
                ->selectRaw('SUM(sale_qty) as qty ,stock_id')
                ->where('sale_date',$date)
                ->where('stocks.dealer_id',$did)->get();
            else{
                $dataSale = Sale::join('leasings','sales.leasing_id','=','leasings.id')
                ->join('stocks','sales.stock_id','stocks.id')
                ->selectRaw('SUM(sale_qty) as qty ,stock_id, leasing_id')
                ->where('sale_date',$date)
                ->where('stocks.dealer_id',$did)
                ->groupBy('stock_id','leasing_id')->get();
            }

            $dataFaktur = StockHistory::where('history_date',$date)
            ->where('dealer_code',$dealer)
            ->orderBy('history_date', 'desc')
            ->sum('faktur');

            $dataService = StockHistory::where('history_date',$date)
            ->where('dealer_code',$dealer)
            ->orderBy('history_date', 'desc')
            ->sum('service');

            $isIdKey = StockHistory::where('history_date',$date)
            ->where('dealer_code',$dealer)->count('id_key');
            if ($isIdKey > 0) {
                $idKey = StockHistory::where('history_date',$date)
                ->where('dealer_code',$dealer)->pluck('id_key');
                $reportId = $idKey[0];
            } else {
                $reportId = null;
            }

            $stockOpname = Opname::join('stocks','opnames.stock_id','stocks.id')
                ->where('stocks.dealer_id',$did)
                ->where('opname_date',$date)->sum('stock_opname');

            $dateOpname = $date;

            $dealerName = Dealer::where('dealer_code',$dealer)->pluck('dealer_name');
            $dealerName = $dealerName[0];

            return view('page', compact('date','firstStock','inYIMM','out','sale','dataInYIMM','dataOut','dataSale','dataInBranch','inBranch','lastStock','reportId','dealerName','dateOpname','stockOpname','dataFaktur','dataService'));
        }
    }

    public function reportSearch(Request $req){
        $rid = $req->rid;
        if ($rid == null) {
            $data = StockHistory::orderBy('id','desc')->limit(20)->get();
        } else {
            $data = StockHistory::where('id_key',$rid)
            ->orderBy('id','desc')->get();
        }
        return view('page', compact('data'));
    }

    public function adjustReport(){
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $dc = Auth::user()->dealer_code;
        if ($dc != 'group') {
            $dealer_name = Dealer::where('dealer_code',$dc)->get();
            $dealer_name = $dealer_name[0];
            return view('page', compact('today','dc','dealer_name'));
        }else{
            return view('page', compact('today'));
        }
    }

    public function adjustReportStore(Request $req){
        $dc = Auth::user()->dealer_code;
        $today = Carbon::now('GMT+8')->format('Y-m-d');

        if ($dc == 'group') {
            $cek = StockHistory::where('history_date',$req->date)
            ->where('dealer_code',$req->dealer_code)->count();

            // Get lastStock
            $date = Carbon::parse($req->date)->format('Y-m-d');
            if ($date != $today) {
                $yesterday = $date->subDay();
                $cekStock = StockHistory::where('dealer_code',$req->dealer_code)
                ->where('history_date',$yesterday)
                ->orderBy('history_date','desc')->count();
                if ($cekStock > 0) {
                    $lastStock = StockHistory::where('dealer_code',$req->dealer_code)
                    ->where('history_date',$yesterday)
                    ->orderBy('history_date','desc')->pluck('last_stock');
                    $lastStock = $lastStock[0];
                } else {
                    $lastStock = 0;
                }
            } else {
                $cekStock = StockHistory::where('dealer_code',$req->dealer_code)
                ->orderBy('history_date','desc')->count();
                if ($cekStock > 0) {
                    $lastStock = StockHistory::where('dealer_code',$req->dealer_code)
                    ->orderBy('history_date','desc')->pluck('last_stock');
                    $lastStock = $lastStock[0];
                } else {
                    $lastStock = 0;
                }
            }

            if ($cek > 0) {
                alert()->warning('Warning','Report date already recorded!');
                return redirect()->back()->withInput($req->input());
            } else {
                $data = new StockHistory;
                $data->history_date = $req->date;
                $data->faktur = $req->faktur;
                $data->service = $req->service;
                $data->id_key = Carbon::now('GMT+8')->format('H').'sh'.$req->dealer_code.Carbon::now('GMT+8')->format('Y').Carbon::now('GMT+8')->format('i').Carbon::now('GMT+8')->format('m').'b'.Carbon::now('GMT+8')->format('d').Carbon::now('GMT+8')->format('s');
                $data->dealer_code = $req->dealer_code;
                $data->first_stock = $lastStock;
                $data->in_qty = 0;
                $data->out_qty = 0;
                $data->sale_qty = 0;
                $data->last_stock = $lastStock;
                $data->status = 'completed';
                $data->created_by = Auth::user()->id;
                $data->updated_by = Auth::user()->id;
                $data->save();

                toast('Adjust stok berhasil disimpan','success');
                return redirect()->back()->withInput();
            }
            
        } else {
            $cek = StockHistroy::where('history_date',$req->date)
            ->where('dealer_code',$dc)->count();
            
            // Get lastStock
            $date = Carbon::parse($req->date)->format('Y-m-d');
            if ($date != $today) {
                $yesterday = $date->subDay();
                $cekStock = StockHistory::where('dealer_code',$req->dealer_code)
                ->where('history_date',$yesterday)
                ->orderBy('history_date','desc')->count();
                if ($cekStock > 0) {
                    $lastStock = StockHistory::where('dealer_code',$req->dealer_code)
                    ->where('history_date',$yesterday)
                    ->orderBy('history_date','desc')->pluck('last_stock');
                    $lastStock = $lastStock[0];
                } else {
                    $lastStock = 0;
                }
            } else {
                $cekStock = StockHistory::where('dealer_code',$req->dealer_code)
                ->orderBy('history_date','desc')->count();
                if ($cekStock > 0) {
                    $lastStock = StockHistory::where('dealer_code',$req->dealer_code)
                    ->orderBy('history_date','desc')->pluck('last_stock');
                    $lastStock = $lastStock[0];
                } else {
                    $lastStock = 0;
                }
            }

            if ($cek > 0) {
                alert()->warning('Warning','Report date already recorded!');
                return redirect()->back()->withInput($req->input());
            } else {
                $data = new StockHistory;
                $data->faktur;
                $data->service;
                $data->id_key = Carbon::now('GMT+8')->format('H').'sh'.$dc.Carbon::now('GMT+8')->format('Y').Carbon::now('GMT+8')->format('i').Carbon::now('GMT+8')->format('m').'b'.Carbon::now('GMT+8')->format('d').Carbon::now('GMT+8')->format('s');
                $data->dealer_code = $dc;
                $data->first_stock = $lastStock;
                $data->in_qty = 0;
                $data->out_qty = 0;
                $data->sale_qty = 0;
                $data->last_stock = $lastStock;
                $data->status = 'completed';
                $data->created_by = Auth::user()->id;
                $data->updated_by = Auth::user()->id;
                $data->save();

                toast('Adjust stok berhasil disimpan','success');
                return redirect()->back();
            }
        }
        
    }
}
