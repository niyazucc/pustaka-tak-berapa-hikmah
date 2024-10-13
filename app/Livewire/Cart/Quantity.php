<?php

namespace App\Livewire\Cart;

use Livewire\Component;

class Quantity extends Component
{
    public $quantity;
    

    public function mount(){

    }

    public function render()
    {
        return view('livewire.cart.quantity');
    }
}
