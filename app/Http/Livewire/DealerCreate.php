<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dealer;
use Auth;

class DealerCreate extends Component
{
    public $dealer_code, $dealer_name, $phone, $address;

    public function dealerCreate(){
        $data = new Dealer;
        $data->dealer_code  = $this->dealer_code;
        $data->dealer_name  = $this->dealer_name;
        $data->phone  = $this->phone;
        $data->address  = $this->address;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();

        $this->emit("dealerCreateListen");

        $this->dealer_code = "";
        $this->dealer_name = "";
        $this->phone = "";
        $this->address = "";
    }

    public function render()
    {
        return view('livewire.dealer-create');
    }
}
