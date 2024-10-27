<?php

namespace App\Livewire\Cart;

use App\Models\Cart;
use App\Traits\NotificationTrait;
use Livewire\Component;

class OrderSummary extends Component
{
    public $cartItems;
    public $total;
    public $shippingMethod = 5; // Default shipping cost is RM5

    use NotificationTrait;
    protected $listeners = ['cartUpdated' => 'refreshOrderSummary'];

    public function mount()
    {
        $this->refreshOrderSummary();
    }

    public function refreshOrderSummary()
    {
        // Fetch the cart items for the authenticated user
        $this->cartItems = Cart::where('customer_id', auth()->id())->with('books')->get();

        // Recalculate the total
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        // Sum up the total cost of cart items
        $itemTotal = $this->cartItems->sum('total');

        // Add the shipping cost to the total
        $this->total = $itemTotal + $this->shippingMethod;
    }

    public function updated()
    {
        // Recalculate the total whenever the shipping method is updated
        $this->calculateTotal();
        if($this->shippingMethod ==5){
            $this->infoNotification('Pickup Address','The address will be at the your stored address');
        }else{
            $this->infoNotification('Pickup Address','The address will be at the JMKNNS store');
        }
    }

    public function render()
    {
        return view('livewire.cart.order-summary', [
            'cartItems' => $this->cartItems,
            'total' => $this->total,
        ]);
    }
}
