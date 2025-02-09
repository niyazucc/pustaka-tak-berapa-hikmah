@extends('layouts.app')
@section('title', 'Order has been placed!')

@section('content')
    <section class="bg-slate-50 py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-2xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">Thanks for your order!</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Your order <a href="#"
                    class="font-medium text-gray-900 dark:text-white hover:underline">#{{ $order->id }}</a> will be
                processed within 24 hours during working days. We will notify you by email once your order has been shipped.
            </p>
            <div
                class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Date</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $order->created_at }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Name</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $order->name }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Address</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $order->address }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Phone</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $order->phone_number }}</dd>
                </dl>
                @php
                    $total = 0;
                    foreach ($order->orderitems as $item) {
                        $total += $item->total;
                    }
                @endphp

                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Orders Total</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">RM{{ $total }}</dd>
                </dl>

                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Shipping Method</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">
                        @if ($order->name == 'Pickup Location')
                            Pickup at store
                        @else
                            Shipping
                        @endif
                    </dd>
                </dl>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('customer.belian') }}"
                    class="text-white bg-red-500 hover:bg-primary-800 focus:ring-4 focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none">View
                    Purchase</a>
                <a href="/"
                    class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Return
                    to shopping</a>
            </div>
        </div>
    </section>
@endsection
