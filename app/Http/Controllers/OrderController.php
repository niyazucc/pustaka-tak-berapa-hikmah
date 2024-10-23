<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Traits\NotificationTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use NotificationTrait;
    public function viewOrderdetails($id)
    {
        $order = Orders::find($id);
        return view('admin.order-details', compact('order'));
    }

    public function updateTracking(Request $request, $id)
    {
        $request->validate([
            'trackingno' => 'required',
        ]);

        $order = Orders::findOrFail($id);

        // Update the tracking number and change the status to "shipping"
        $order->trackingno = $request->input('trackingno');
        $order->orderstatus = 'Shipping';
        $order->save();

        $this->infoNotification('Tracking number updated and status set to shipping.');
        return redirect()->back();
    }

    public function view()
    {
        $orders = Orders::all();
        return view('admin.orders', compact('orders'));
    }
}
