<?php

namespace App\Http\Controllers;

use App\Livewire\Cart\CartItems;
use App\Traits\NotificationTrait;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Exception;

class StripeController extends Controller
{
    use NotificationTrait;

    public function stripeCheckout(Request $request)
    {
        // dd('stripe secret:'.env('STRIPE_SECRET'));
        $cartItems = session()->get('cartItems');
        // dd('cartITems:'.$cartItems);

        // Set Stripe secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Retrieve the cart items and total from the session

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
                    'unit_amount' => $cartItem->books->price * 100, // Stripe expects amounts in cents
                ],
                'quantity' => $cartItem->quantity,
            ];
        }

        try {
            // Create a Stripe Checkout session
            $session = Session::create([
                'payment_method_types' => ['card','fpx'],
                'line_items' => [$lineItems],
                'mode' => 'payment',
                'success_url' => route('customer.payment.success'),
                'cancel_url' => route('customer.payment.cancel'),
            ]);



            // Redirect to Stripe's checkout page
            return redirect($session->url);
        } catch (\Exception $e) {
            print($e->getMessage());die();
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    public function success()
    {
        $this->popupNotification('Thank you!','Order has been placed');
        return view('success');
    }

    public function cancel()
    {
        $this->dangerNotification('Payment has been canceled.');
        return to_route('customer.view');
    }
}

