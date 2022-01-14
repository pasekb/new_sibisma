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
        $year = Carbon::now('GMT+8')->format('Y');
        $lastMonth = Carbon::now('GMT+8')->subMonth()->format('Y-m');
        $lastYear = Carbon::now('GMT+8')->format('Y') - 1;
        $yearSales = Sale::whereYear('sale_date',$year)->sum('sale_qty');

        // vs LY
        $LY = Sale::whereYear('sale_date',$lastYear)->sum('sale_qty');
        if($LY <= 0 && $yearSales <= 0){
            $vsLYach = 0;
            $vsLY = 0;
        }elseif ($LY <= 0 || $yearSales <= 0) {
            if ($LY <= 0) {
                $vsLYach = ($yearSales/$yearSales);
                $vsLY = ($LY)*100;
            } else {
                $vsLYach = 0;
                $vsLY = (0-$LY)*100;
            }
        } else {
            $vsLYach = ($yearSales/$LY)*100;
            $vsLY = ($yearSales/$LY-1)*100;
        }

        return view('livewire.sale-l-y', compact('today','vsLY','lastYear','vsLYach'));
    }
}
