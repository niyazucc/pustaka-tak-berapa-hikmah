@extends('layouts.app')
@section('title', 'Cart Aku')

@section('content')
    <section class="py-8 antialiased md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Troli Ku</h2>

            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6">

                        @if ($carts->count() > 0)
                            {{-- start cart list --}}
                            @foreach ($carts as $cart)
                                @livewire(
                                    'cart.cart-items',
                                    [
                                        'cart' => $cart,
                                    ],
                                    key($cart->id)
                                )
                            @endforeach
                            {{-- end cart list --}}
                        @else
                            <p>Your cart is empty.</p>
                        @endif

                    </div>
                </div>

                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    @livewire('cart.order-summary')
                </div>
            </div>
        </div>
    </section>

@endsection
