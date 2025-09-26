<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Session;
use InvModels\SharedModels\FormOrderSupplyTypes;
use Livewire\Component;

class Supplytable extends Component
{
    public $supplies;
    protected $listeners = ['UpdateCart' => 'render'];

    public function render()
    {
        if (!empty(Session::get("supplies")))
            $this->supplies = Session::get("supplies");
        return view('livewire.supplytable');
    }
}
