<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use NotificationTrait;

    public function view(Request $request)
    {

        $carts = Cart::where('customer_id', auth()->id())->with('books')->get();

        $total = $request->input('total');

        $categories = Category::withCount('books')->get(); //header

        // Store cart items and total in the session for later use (optional)
        $request->session()->put('cartItems', $carts);
        $request->session()->put('total', $total);
        return view('cart', compact('carts', 'categories'));
    }
    public function add(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            $this->infoNotification('Oh no!', 'Please log in to add items to your cart.');
            return redirect()->route('login');
        }

        $bookid = $request->book_id;
        $quantity = $request->quantity;
        $price = $request->price;

        $book = Book::find($bookid); // Assuming you have a Book model
        $existingCartItem = Cart::where('customer_id', $user->id)
            ->where('bookid', $bookid)
            ->first();

        // Calculate total quantity in cart + new quantity
        $totalQuantity = $existingCartItem ? $existingCartItem->quantity + $quantity : $quantity;

        // Check if total quantity exceeds stock
        if ($totalQuantity > $book->stockcount) {
            $this->dangerNotification('Not enough stock available.', 'Only ' . $book->stockcount . ' items left.');
            return redirect()->back();
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
        $this->popupNotification('','Book added to cart successfully!');
        return redirect()->back();
    }
}
