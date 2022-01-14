<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;

class SaleLM extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $year = Carbon::now('GMT+8')->format('Y');
        $tgl = Carbon::now('GMT+8');
        $lastMonth = $tgl->subMonth()->format('m');
        $lastMonthY = $tgl->subMonth()->format('Y');
        $monthSales = Sale::whereMonth('sale_date',$month)->whereYear('sale_date',$year)->sum('sale_qty');

        // vs LM
        $LM = Sale::whereMonth('sale_date',$lastMonth)->whereYear('sale_date',$lastMonthY)->sum('sale_qty');
        
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

        return view('livewire.sale-l-m', compact('today','lastMonth','vsLM','vsLMach'));
    }
}
