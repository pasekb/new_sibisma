<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Entry;
use Carbon\Carbon;

class EntryLM extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m');
        $tgl = Carbon::now('GMT+8');
        $lastMonth = $tgl->subMonth()->format('Y-m');
        $monthEntry = Entry::whereMonth('entry_date',$month)->sum('in_qty');

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

        return view('livewire.entry-l-m', compact('today','lastMonth','vsLM','vsLMach'));
    }
}
