<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\Stripe;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Addresses;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Livewire\Cart\CartItems;
use App\Traits\NotificationTrait;

class StripeController extends Controller
{
    use NotificationTrait;

    public function stripeCheckout(Request $request)
    {
        // dd('yoyo');
        $shippingPrices = $request->shippingPrice;
        $cartItems = session()->get('cartItems');

        // Set Stripe secret key
        Stripe::setApiKey('sk_test_51NMTv4B2aRfvWXCr29pqjqchRHN2myOgvNU5SwxKdub6Rj5v1u6BVA7yo9SkiIsUtukhEG0Omz717XE2QFwj1CcK00azmKO0Lb');

        // Retrieve the total from the session
        $total = session()->get('total');

        // Prepare line items for Stripe Checkout
        $lineItems = [];
        foreach ($cartItems as $cartItem) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => $cartItem->books->title,
                    ],
                    'unit_amount' => $cartItem->price * 100, // Stripe expects amounts in cents
                ],
                'quantity' => $cartItem->quantity,
            ];
        }

        // Add shipping cost as a separate line item
        $lineItems[] = [
            'price_data' => [
                'currency' => 'myr',
                'product_data' => [
                    'name' => 'Shipping Cost',
                ],
                'unit_amount' => $shippingPrices * 100, // Convert to cents
            ],
            'quantity' => 1,
        ];

        try {
            // Create a Stripe Checkout session
            $session = Session::create([
                'payment_method_types' => ['card', 'fpx'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route(
                    'customer.payment.success',
                    ['shippingMethod' => $shippingPrices]
                ),
                'cancel_url' => route('customer.payment.cancel'),
            ]);

            // Redirect to Stripe's checkout page
            return redirect($session->url);
        } catch (\Exception $e) {
            $this->dangerNotification('Error!','$e->getMessage()');
            return back();
        }
    }


    public function success(Request $request)
    {
        // dd($request->shippingMethod);
        $customerId = auth()->id(); // Assuming the customer is authenticated
        $address = Addresses::where('customer_id', $customerId)->first();

        // Get the payment method from the request


        // Get the customer's cart items
        $cartItems = Cart::where('customer_id', $customerId)->get();

        if ($cartItems->isEmpty()) {
            // Handle the case where the cart is empty
            dd('cart is empty');
            session()->flash('error', 'Your cart is empty!');
            return redirect()->back();
        }

        // Determine the address based on the shipping method
        if ($request->shippingMethod == 5) {
            // Use the customer's saved address
            $orderAddress = [
                'name' => $address->name,
                'address' => $address->address,
                'city' => $address->city,
                'state' => $address->state,
                'zip' => $address->zip,
                'country' => $address->country,
                'phone_number' => $address->phone_number,
            ];
        } else {
            // Use the default pickup address
            $orderAddress = [
                'name' => 'Pickup Location',
                'address' => 'Aras 15, Menara MAINS, Jalan Taman Bunga',
                'city' => 'Seremban',
                'state' => 'Negeri Sembilan Darul Khusus',
                'zip' => '70100',
                'country' => 'Malaysia',
                'phone_number' => '1234567890', // Provide a default phone number for the pickup location
            ];
        }

        // Create a new order
        $order = Orders::create([
            'customer_id' => $customerId,
            'name' => $orderAddress['name'],
            'address' => $orderAddress['address'],
            'city' => $orderAddress['city'],
            'state' => $orderAddress['state'],
            'zip' => $orderAddress['zip'],
            'country' => $orderAddress['country'],
            'phone_number' => $orderAddress['phone_number'],
            'orderstatus' => 'Paid', // Set the initial status as 'Paid'
        ]);
        // Insert the cart items into the order_items table
        foreach ($cartItems as $item) {
            OrderItems::create([

                'order_id' => $order->id,
                'book_id' => $item->bookid,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->total,
            ]);
            // Deduct the stock for the book
            $book = Book::find($item->bookid);
            if ($book) {
                $book->stockcount -= $item->quantity;
                $book->save();
            }
        }
        $categories = Category::withCount('books')->get();
        // Clear the cart for the customer
        // print_r($order);die();
        Cart::where('customer_id', $customerId)->delete();
        $this->popupNotification('Thank you!', 'Order has been placed');
        // print_r($orderDetails);die();
        return view('success', compact('categories', 'order'));
    }

    public function cancel()
    {
        $categories = Category::withCount('books')->get();
        $this->dangerNotification('Payment has been canceled.');
        return to_route('customer.view', compact('categories'));
    }
}
