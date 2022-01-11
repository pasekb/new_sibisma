<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Entry;
use App\Models\Out;
use Carbon\Carbon;

class RatioStock extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $tgl = Carbon::now('GMT+8');
        $monthSales = Sale::whereMonth('sale_date',$month)->sum('sale_qty');
        
        // Total Sales
        $totalSales = Sale::where('sale_date',$today)->sum('sale_qty');
        // Total Sales
        $totalEntry = Entry::where('entry_date',$today)->sum('in_qty');
        // Total Sales
        $totalOut = Out::where('out_date',$today)->sum('out_qty');

        // Ratio Percentage
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
        
        return view('livewire.ratio-stock', compact('ratio','ratioPercent','totalSales','totalEntry','totalOut','today'));
    }
}
