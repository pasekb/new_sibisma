<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Entry;
use App\Models\Sale;
use App\Models\Stock;
use Carbon\Carbon;

class EntryInfo extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $tgl = Carbon::now('GMT+8');
        $lastMonth = $tgl->subMonth()->format('Y-m');
        $lastYear = Carbon::now('GMT+8')->format('Y') - 1;
        $monthEntry = Entry::whereMonth('entry_date',$month)->sum('in_qty');

        // Total Entry
        $totalEntry = Entry::where('entry_date', $today)->sum('in_qty');

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
        $LM = Entry::whereMonth('entry_date',$lastMonth)->sum('in_qty');
        if($LM <= 0 && $monthEntry <= 0){
            $vsLMach = 0;
        }elseif ($LM <= 0 || $monthEntry <= 0) {
            if ($LM <= 0) {
                $vsLMach = ($monthEntry/$monthEntry);
            } else {
                $vsLMach = ($LM/$LM);
            }
        } else {
            $vsLMach = ($monthEntry/$LM)*100;
        }

        $vsLM = ($vsLMach-1)*100;

        // vs LY
        $LY = Entry::whereMonth('entry_date',$lastYear)->sum('in_qty');
        if($LY <= 0 && $monthEntry <= 0){
            $vsLYach = 0;
        }elseif ($LY <= 0 || $monthEntry <= 0) {
            if ($LY <= 0) {
                $vsLYach = ($monthEntry/$monthEntry);
            } else {
                $vsLYach = ($LY/$LY);
            }
        } else {
            $vsLYach = ($monthEntry/$LY)*100;
        }

        $vsLY = ($vsLYach-1)*100;

        return view('livewire.entry-info', compact('today','totalEntry','ratioPercent','ratio','lastMonth','lastYear','vsLM','vsLMach','vsLY','vsLYach'));
    }
}
