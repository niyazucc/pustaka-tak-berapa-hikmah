<?php

namespace App\Livewire\Cart;

use App\Models\Cart;
use Livewire\Component;

class OrderSummary extends Component
{
    public $cartItems;
    public $total;

    protected $listeners = ['cartUpdated' => 'refreshOrderSummary'];

    public function mount()
    {
        $this->refreshOrderSummary();
    }

    public function refreshOrderSummary()
    {
        // Fetch the cart items for the authenticated user
        $this->cartItems = Cart::where('customer_id', auth()->id())->with('books')->get();

        // Calculate the total order amount
        $this->total = $this->cartItems->sum('total');
    }

    public function render()
    {
        return view('livewire.cart.order-summary', [
            'cartItems' => $this->cartItems,
            'total' => $this->total,
        ]);
    }
}
