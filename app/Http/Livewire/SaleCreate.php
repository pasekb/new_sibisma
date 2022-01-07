<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stock;
use App\Models\Leasing;

class SaleCreate extends Component
{
    public function render()
    {
        $stock = Stock::all();
        $leasing = Leasing::all();
        return view('livewire.sale-create', compact('stock','leasing'));
    }
}
