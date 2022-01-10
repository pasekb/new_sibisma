<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stock;

class WidgetStockQty extends Component
{
    public function render()
    {
        $stock = Stock::sum('qty');
        return view('livewire.widget-stock-qty', compact('stock'));
    }
}
