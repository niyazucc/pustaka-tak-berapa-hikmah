<?php

namespace App\Livewire;
use App\Models\Cart;
use App\Traits\NotificationTrait;
use Livewire\Component;

use Laravel\Jetstream\InteractsWithBanner;

class DeleteCartItem extends Component
{
    use NotificationTrait;
    use InteractsWithBanner;
    public $id;
    public $cartItemId; // Store the ID of the cart item to be deleted
    public $showDeleteModal = false; // Modal visibility state

    public function confirmDelete($id)
    {
        $this->cartItemId = $id;
        $this->showDeleteModal = true;
    }
    public function deleteBookFromCart(){
        $cartItem = Cart::find(id: $this->id);

        if ($cartItem) {
            $cartItem->delete();
            $this->popupNotification('Item have been removed successfully!');
            return;
            // session()->flash('success', 'Item have been removed successfully!');
        } else {
            session()->flash('error', 'Ada error!');
        }
    }
    public function render()
    {
        return view('livewire.delete-cart-item');
    }
}
