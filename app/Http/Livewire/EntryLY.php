<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Entry;
use Carbon\Carbon;

class EntryLY extends Component
{
    public function render()
    {
        $today = Carbon::now('GMT+8')->format('Y-m-d');
        $month = Carbon::now('GMT+8')->format('m'); 
        $tgl = Carbon::now('GMT+8');
        $lastMonth = $tgl->subMonth()->format('Y-m');
        $lastYear = Carbon::now('GMT+8')->format('Y') - 1;
        $monthEntry = Entry::whereMonth('entry_date',$month)->sum('in_qty');

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

        return view('livewire.entry-l-y',compact('today','lastYear','vsLY','vsLYach'));
    }
}
