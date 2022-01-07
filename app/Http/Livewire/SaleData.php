<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;


class SaleData extends Component
{
    public function render()
    {
        $tgl = Carbon::now('GMT+8')->format('Y-m-d');
        $data = Sale::where('sale_date',$tgl)->orderBy('sale_date','desc')->get();
        return view('livewire.sale-data', compact('data','tgl'));
    }
}
