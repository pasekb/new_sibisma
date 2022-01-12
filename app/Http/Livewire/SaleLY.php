<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;

class SaleLY extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $tgl = Carbon::now('GMT+8');
        $lastMonth = $tgl->subMonth()->format('Y-m');
        $lastYear = Carbon::now('GMT+8')->format('Y') - 1;
        $monthSales = Sale::whereMonth('sale_date',$month)->sum('sale_qty');

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

        return view('livewire.sale-l-y', compact('today','vsLY','lastYear','vsLYach'));
    }
}
