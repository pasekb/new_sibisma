<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Out;
use App\Models\Stock;
use Carbon\Carbon;

class OutInfo extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $tgl = Carbon::now('GMT+8');
        $lastMonth = $tgl->subMonth()->format('Y-m');
        $lastYear = Carbon::now('GMT+8')->format('Y') - 1;
        
        // Total Out
        $totalOut = Out::where('out_date',$today)->sum('out_qty');

        // Ratio Percentage
        $monthOut = Out::whereMonth('out_date',$month)->sum('out_qty');
        $stockQty = Stock::sum('qty');

        if ($stockQty <= 0) {
            $ratioPercent = 0*100;
        } else {
            $ratioPercent = ($monthOut/($stockQty + $monthOut))*100;
        }
        
        $ratioPercent = number_format($ratioPercent,0);

        if ($monthOut <= 0 && $stockQty <= 0) {
            $ratio = 0;
        }elseif($monthOut <= 0 || $stockQty <= 0){
            if ($monthOut <= 0) {
                $ratio = $stockQty/$stockQty;
            } else {
                $ratio = $monthOut/$monthOut;
            }
        } else {
            $ratio = $stockQty/$monthOut;
        }
        
        $ratio = number_format($ratio, 2);

        // vs LM
        $LM = Out::whereMonth('out_date',$lastMonth)->sum('out_qty');
        if($LM <= 0 && $monthOut <= 0){
            $vsLMach = 0;
        }elseif ($LM <= 0 || $monthOut <= 0) {
            if ($LM <= 0) {
                $vsLMach = ($monthOut/$monthOut);
            } else {
                $vsLMach = ($LM/$LM);
            }
        } else {
            $vsLMach = ($monthOut/$LM)*100;
        }

        $vsLM = ($vsLMach-1)*100;

        // vs LY
        $LY = Out::whereMonth('out_date',$lastYear)->sum('out_qty');
        if($LY <= 0 && $monthOut <= 0){
            $vsLYach = 0;
        }elseif ($LY <= 0 || $monthOut <= 0) {
            if ($LY <= 0) {
                $vsLYach = ($monthOut/$monthOut);
            } else {
                $vsLYach = ($LY/$LY);
            }
        } else {
            $vsLYach = ($monthOut/$LY)*100;
        }

        $vsLY = ($vsLYach-1)*100;

        // dd($ratioPercent);

        return view('livewire.out-info', compact('totalOut','ratioPercent','ratio','today','lastMonth','lastYear','vsLM','vsLMach','vsLY','vsLYach'));
    }
}
