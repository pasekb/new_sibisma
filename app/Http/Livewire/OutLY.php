<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Out;
use Carbon\Carbon;

class OutLY extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $tgl = Carbon::now('GMT+8');
        $lastMonth = $tgl->subMonth()->format('Y-m');
        $lastYear = Carbon::now('GMT+8')->format('Y') - 1;
        $monthOut = Out::whereMonth('out_date',$month)->sum('out_qty');

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

        return view('livewire.out-l-y', compact('today','lastYear','vsLY','vsLYach'));
    }
}
