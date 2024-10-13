<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Cart;
use App\Models\User;
use App\Traits\NotificationTrait;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Addtocart extends Component
{
    use NotificationTrait;
    public $bookid;
    public $quantity;
    public $price;

    public function add($bookid, $quantity, $price)
    {
        $user = Auth::user();
        if (!$user) {
            $this->infoNotification('Oh no!','Please log in to add items to your cart.');
            return redirect()->route('login');
        }

        $book = Book::find($bookid); // Assuming you have a Book model
        $existingCartItem = Cart::where('customer_id', $user->id)
            ->where('bookid', $bookid)
            ->first();

        // Calculate total quantity in cart + new quantity
        $totalQuantity = $existingCartItem ? $existingCartItem->quantity + $quantity : $quantity;

        // Check if total quantity exceeds stock
        if ($totalQuantity > $book->stockcount) {
            $this->dangerNotification('Not enough stock available.','Only ' . $book->stockcount . ' items left.');
            return;
        }

        // Add to cart or update the quantity if the item already exists
        if ($existingCartItem) {
            $existingCartItem->update([
                'quantity' => $totalQuantity,
                'total' => $totalQuantity * $price
            ]);
        } else {
            Cart::create([
                'customer_id' => $user->id,
                'bookid' => $bookid,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $quantity * $price
            ]);
        }
        $this->dispatch('cartUpdated');
        $this->popupNotification('','Book added to cart successfully!');
    }

    public function render()
    {
        return view('livewire.addtocart');
    }
}
