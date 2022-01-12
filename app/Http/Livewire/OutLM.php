<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Out;
use Carbon\Carbon;

class OutLM extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $tgl = Carbon::now('GMT+8');
        $lastMonth = $tgl->subMonth()->format('Y-m');
        $lastYear = Carbon::now('GMT+8')->format('Y') - 1;
        $monthOut = Out::whereMonth('out_date',$month)->sum('out_qty');

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

        return view('livewire.out-l-m', compact('today','lastMonth','vsLM','vsLMach'));
    }
}
