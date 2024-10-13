<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\NotificationTrait;

class CartController extends Controller
{
    use NotificationTrait;
    public function view(Request $request){

        $carts = Cart::where('customer_id', auth()->id())->with('books')->get();

        $total = $request->input('total');

        $categories = Category::withCount('books')->get(); //header

        // Store cart items and total in the session for later use (optional)
        $request->session()->put('cartItems', $carts);
        $request->session()->put('total', $total);
        return view('cart',compact('carts','categories'));
    }
}
