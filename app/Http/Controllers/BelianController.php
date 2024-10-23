<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Category;
use Illuminate\Http\Request;

class BelianController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')->get();
        return view('belian', compact('categories'));
    }
    public function viewOrderDetails($orders_id)
    {

        $orders = Orders::findOrFail($orders_id);
        // print_r($orders);
        // die();
        $categories = Category::withCount('books')->get();
        return view('belian-details', compact('categories', 'orders'));
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->orderstatus = $request->input('orderstatus');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated to Received.');
    }
}
