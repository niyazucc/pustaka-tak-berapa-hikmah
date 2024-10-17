<?php

namespace App\Livewire\Cart;

use App\Models\Cart;
use App\Traits\NotificationTrait;
use Livewire\Component;


class CartItems extends Component
{
    use NotificationTrait;
    public $cart;
    public $quantity;
    public $cartItemId; // Store the ID of the cart item to be deleted
    public $showDeleteModal = false; // Modal visibility state
    public function mount($cart)
    {
        // Set initial quantity from the cart
        $this->cart = $cart;
        $this->quantity = $cart->quantity;
    }

    // Method to increment the quantity
    public function incrementQuantity()
    {
        if ($this->quantity < $this->cart->books->stockcount) {
            $this->quantity++;
            $this->updateCart(); // Call method to update the database
        }
    }

    // Method to decrement the quantity
    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->updateCart(); // Call method to update the database
        }
    }

    // Method to update the quantity and total in the database
    public function updateCart()
    {
        $this->dispatch('cartUpdated');
        $total = round($this->quantity * $this->cart->price, 2); // Round to 2 decimal places

        // Update the cart quantity and total in the database
        $this->cart->update([
            'quantity' => $this->quantity,
            'total' => $total, // Update the total with double format
        ]);
    }
    public function closeModal()
    {
        $this->showDeleteModal = false;
    }

    public function confirmDelete($id)
    {
        $this->cartItemId = $id;
        $this->showDeleteModal = true;
    }

    // Method to delete the book from the cart
    public function deleteBookFromCart($id)
    {
        $this->dispatch('cartUpdated');
        Cart::find($id)->delete();
        $this->popupNotification('', 'Item have been removed successfully!');
        return redirect()->route('customer.view');
    }


    public function render()
    {
        return view('livewire.cart.cart-items');
    }
}
