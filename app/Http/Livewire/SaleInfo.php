<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Stock;
use Carbon\Carbon;

class SaleInfo extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $tgl = Carbon::now('GMT+8');
        $lastMonth = $tgl->subMonth()->format('Y-m');
        $lastYear = Carbon::now('GMT+8')->format('Y') - 1;

        // Total Sales
        $totalSales = Sale::where('sale_date',$today)->sum('sale_qty');

        // Ratio Percentage
        $monthSales = Sale::whereMonth('sale_date',$month)->sum('sale_qty');
        $stockQty = Stock::sum('qty');

        if ($stockQty <= 0) {
            $ratioPercent = 0*100;
        } else {
            $ratioPercent = ($monthSales/($stockQty + $monthSales))*100;
        }
        
        $ratioPercent = number_format($ratioPercent,0);

        if ($monthSales <= 0 && $stockQty <= 0) {
            $ratio = 0;
        }elseif($monthSales <= 0 || $stockQty <= 0){
            if ($monthSales <= 0) {
                $ratio = $stockQty/$stockQty;
            } else {
                $ratio = $monthSales/$monthSales;
            }
        } else {
            $ratio = $stockQty/$monthSales;
        }
        
        $ratio = number_format($ratio, 2);

        // vs LM
        $LM = Sale::whereMonth('sale_date',$lastMonth)->sum('sale_qty');
        if($LM <= 0 && $monthSales <= 0){
            $vsLMach = 0;
        }elseif ($LM <= 0 || $monthSales <= 0) {
            if ($LM <= 0) {
                $vsLMach = ($monthSales/$monthSales);
            } else {
                $vsLMach = ($LM/$LM);
            }
        } else {
            $vsLMach = ($monthSales/$LM)*100;
        }

        $vsLM = ($vsLMach-1)*100;

        // vs LY
        $LY = Sale::whereMonth('sale_date',$lastYear)->sum('sale_qty');
        if($LY <= 0 && $monthSales <= 0){
            $vsLYach = 0;
        }elseif ($LY <= 0 || $monthSales <= 0) {
            if ($LY <= 0) {
                $vsLYach = ($monthSales/$monthSales);
            } else {
                $vsLYach = ($LY/$LY);
            }
        } else {
            $vsLYach = ($monthSales/$LY)*100;
        }

        $vsLY = ($vsLYach-1)*100;

        // dd($ratioPercent);
        return view('livewire.sale-info', compact('totalSales','ratioPercent','ratio','today','lastMonth','lastYear','vsLM','vsLMach','vsLY','vsLYach'));
    }
}
