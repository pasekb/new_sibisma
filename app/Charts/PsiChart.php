<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Dealer;
use App\Models\Stock;
use App\Models\Out;
use App\Models\Entry;
use App\Models\StockHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PsiChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $dc = Auth::user()->dealer_code;
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $yearNow = Carbon::now('GMT+8')->format('Y');
        $thisMonth = Carbon::now('GMT+8')->format('m');

        if ($dc == 'group') {
            $sale = [];
            $stock = [];
            $in = [];
            $ratio = [];
            for ($i=1; $i < 13; $i++) {
                $dataSale = Sale::whereMonth('sale_date',$i)
                ->whereYear('sale_date',$yearNow)
                ->sum('sale_qty');

                $dataOut = Out::whereMonth('out_date',$i)
                ->whereYear('out_date',$yearNow)
                ->sum('out_qty');

                $dataSaleOut = $dataSale + $dataOut;

                $dataIn = Entry::whereMonth('entry_date',$i)
                ->whereYear('entry_date',$yearNow)
                ->sum('in_qty');

                $dataStock = StockHistory::whereMonth('history_date',$i)
                ->whereYear('history_date',$yearNow)
                ->sum('last_stock');

                if ($dataSaleOut == 0) {
                    $dataRatio = 0;
                } else {
                    $dataRatio = (int)$dataStock / (int)$dataSaleOut;
                }

                array_push($sale, $dataSaleOut);
                array_push($stock, $dataStock);
                array_push($in, $dataIn);
                array_push($ratio, $dataRatio);
            }
            // dd($sale, $in, $out);
        } else {
            $sale = [];
            $stock = [];
            $in = [];
            $ratio = [];
            for ($i=1; $i < 13; $i++) {
                $dataSale = Sale::join('stocks','sales.stock_id','stocks.id')
                ->where('stocks.dealer_id', $did)
                ->whereMonth('sale_date',$i)
                ->whereYear('sale_date',$yearNow)
                ->sum('sale_qty');

                $dataOut = Out::join('stocks','outs.stock_id','stocks.id')
                ->where('stocks.dealer_id', $did)
                ->whereMonth('out_date',$i)
                ->whereYear('out_date',$yearNow)
                ->sum('out_qty');

                $dataSaleOut = $dataSale + $dataOut;

                $dataIn = Entry::join('stocks','entries.stock_id','stocks.id')
                ->where('stocks.dealer_id', $did)
                ->whereMonth('entry_date',$i)
                ->whereYear('entry_date',$yearNow)
                ->sum('in_qty');

                $dataStock = StockHistory::where('dealer_code',$dc)
                ->whereMonth('history_date',$i)
                ->whereYear('history_date',$yearNow)
                ->sum('last_stock');

                if ($dataSaleOut == 0) {
                    $dataRatio = 0;
                } else {
                    $dataRatio = (int)$dataStock / (int)$dataSaleOut;
                }
                // dd($dataRatio);

                array_push($sale, $dataSaleOut);
                array_push($stock, $dataStock);
                array_push($in, $dataIn);
                array_push($ratio, $dataRatio);
            }
            // dd($sale, $in, $stock);
        }
        


        return Chartisan::build()
            ->labels(['Jan', 'Feb', 'Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'])
            ->dataset('Sales', $sale)
            ->dataset('Delivery', $in)
            ->dataset('Stock', $stock)
            ->dataset('Stock Ratio', $ratio);
    }
}