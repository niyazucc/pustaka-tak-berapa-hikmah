<div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
    <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

    @if ($cartItems->isNotEmpty())
    <div class="space-y-4">

        <div class="space-y-2">
            @foreach ($cartItems as $cartItem)
                <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $cartItem->books->title }} x{{ $cartItem->quantity }}</dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">RM{{ $cartItem->total }}</dd>
                </dl>
            @endforeach
        </div>

        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
            <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
            <dd class="text-base font-bold text-gray-900 dark:text-white">RM{{ $total }}</dd>
        </dl>


    </div>

    <form action="{{route('customer.payment')}}" method="POST">
        @csrf
        <input type="hidden" name="addresses_id" value="">
        <button class="flex w-full items-center justify-center rounded-lg bg-red-500 px-5 py-2.5 text-sm text-white font-medium focus:outline-none focus:ring-4" type="submit" id="checkout-button">Proceed to Checkout</button>
    </form>
    @else
    <p>Nothing to show here.</p>
    @endif
</div>
