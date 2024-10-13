<?php

namespace App\Livewire\Cart;
use App\Models\Cart;
use Livewire\Component;

class CartQuantity extends Component
{
    public $cartQuantity = 0;
    protected $listeners = ['cartUpdated' => 'updateCartCount'];
    public function mount()
    {
        $this->cartQuantity = Cart::where('customer_id', auth()->id())->count();
    }
    public function updateCartQuantity()
    {
        if (auth()->check()) {
            $userId = auth()->id();
            // Calculate the total quantity of items in the user's cart
            $this->cartQuantity = Cart::where('customer_id', $userId)->sum('quantity');
        } else {
            $this->cartQuantity = 0;
        }
    }
    public function updateCartCount()
    {
        // Update the cart count when the cart is updated
        $this->cartQuantity = Cart::where('customer_id', auth()->id())->count();
    }

    public function render()
    {
        return view('livewire.cart.cart-quantity');
    }
}
