<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Dealer;
use App\Models\Out;
use App\Models\Entry;
use App\Models\StockHistory;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class PsiChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $id = Auth::user()->id;
        $dc = User::where('id',$id)->pluck('dealer_code');
        $dc = $dc[0];
        $did = Dealer::where('dealer_code',$dc)->sum('id');
        $yearNow = Carbon::now('GMT+8')->format('Y');

        if ($dc == 'group') {
            $sale = [];
            $stock = [];
            $in = [];
            $ratio = [];
            $dCode = [];
            $countCode = Dealer::groupBy('dealer_code')->pluck('dealer_code');
            $dataStockGroup = [];

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

                for ($a=0; $a < count($countCode); $a++) { 
                    array_push($dCode, $countCode[$a]);
                }

                // dd($dCode);
                for ($b=0; $b < count($dCode); $b++) {
                    $dataStock = StockHistory::where('dealer_code',$dCode[$b])
                    ->whereMonth('history_date',$i)
                    ->whereYear('history_date',$yearNow)
                    ->orderBy('history_date','desc')
                    ->limit(1)
                    ->pluck('last_stock');

                    if (count($dataStock) == 0 ) {
                        $dataStock = 0;
                    } else {
                        $dataStock = $dataStock[0];
                    }

                    array_push($dataStockGroup, $dataStock);
                }
                
                $dataStock = array_sum($dataStockGroup);
                // dd($dataStockGroup);

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
                ->orderBy('history_date','desc')
                ->limit(1)
                ->pluck('last_stock');

                if (count($dataStock) == 0 ) {
                    $dataStock = 0;
                } else {
                    $dataStock = $dataStock[0];
                }

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