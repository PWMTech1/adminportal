<?php

namespace App\Http\Livewire;

use Livewire\Component;
use InvModels\SharedModels\FormOrderSupplyTypes;

class Supplylist extends Component
{
    public $supply;
    public function render()
    {
        $this->supply = FormOrderSupplyTypes::where('Active', '=', 1)->orderBy("Category")->get();
        return view('livewire.supplylist');
    }

    public function addToOrder($id)
    {
        $cart = request()->session()->get("supplies");

        if (empty($cart[$id])) {
            $formsupplytypes = FormOrderSupplyTypes::where("Id", $id)->get();
            $cart = [
                $id => [
                    "Id" => $formsupplytypes[0]->Id,
                    "Description" => $formsupplytypes[0]->Description,
                    "Qty" => 1,
                    "Unit" => $formsupplytypes[0]->Unit
                ]
            ];
            request()->session()->put('supplies', $cart);
        }

        if (isset($cart[$id])) {
            $cart[$id]['Qty']++;
            request()->session()->put('supplies', $cart);
        }
        $this->emit('UpdateCart');
    }
}
