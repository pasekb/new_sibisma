<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Stock;
use Carbon\Carbon;

class EntryInfo extends Component
{
    public function render()
    {
        return view('livewire.entry-info');
    }
}
