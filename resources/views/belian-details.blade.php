@extends('layouts.app')
@section('title', 'Belian Ku')

@section('content')
    <section class="py-4 md:py-8 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <!-- Order Details -->
            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900">Order Details: #{{ $orders->id }}</h2>
                <h2 class="text-xl font-bold text-gray-900">{{ $orders->orderstatus }}</h2>
            </div>

            {{-- start order received --}}
            @if ($orders->orderstatus == 'Shipping')
                <div class=" p-4 border-solid border-2 bg-red-200 border-red-400 rounded-lg shadow mb-6">
                    <h3 class="text-lg font-semibold mb-2">Order Received?</h3>
                    <p class="text-gray-700">Have your order arrived? If yes, please confirm it &#10083;</p>
                    <form action="{{ route('customer.updateStatus', $orders->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="orderstatus" value="Completed">
                        <button type="submit"
                            class="mt-3 px-4 py-2 bg-red-500 border-red-400 text-white rounded-lg shadow">
                            Confirm Order Received
                        </button>
                    </form>
                </div>
            @endif
            {{-- end order received --}}

            <!-- Delivery Address -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <h3 class="text-lg font-semibold mb-2">Delivery Address</h3>
                {{-- @if ($orders->user && $orders->user->addresses) --}}
                <p class="text-gray-700">
                    {{ $orders->address }}<br>
                    {{ $orders->city }}, {{ $orders->state }}<br>
                    {{ $orders->zip }}, {{ $orders->country }}<br>
                    Phone: {{ $orders->phone_number }}
                </p>
                {{-- @else
                <p class="text-gray-500">No delivery address available.</p>
            @endif --}}
            </div>

            <!-- Books in the Order -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Books Purchased</h3>
                <ul class="divide-y divide-gray-200">
                    @php
                        $orderTotal = 0; // Initialize order total
                    @endphp
                    @foreach ($orders->orderitems as $item)
                        @php
                            $orderTotal += $item->total; // Accumulate the total for each item
                        @endphp
                        <li class="py-4 flex justify-between">
                            <div>
                                <a href="{{ route('bookDetails', ['id' => $item->book->id]) }}"
                                    class="font-medium text-gray-900">{{ $item->book->title ?? 'Unknown Book' }}</a>
                                <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <div>
                                <p class="text-gray-900 font-semibold">Price: MYR {{ number_format($item->price, 2) }}</p>
                                <p class="text-gray-500">Total: MYR {{ number_format($item->total, 2) }}</p>
                            </div>
                        </li>
                    @endforeach

                    @if ($orders->name !== 'Pickup Location')
                        @php
                            $orderTotal += 5; // Add 5 to the total if not a Pickup Location
                        @endphp
                    @endif

                    <li class="py-4 flex justify-between">

                        <div>
                            <p class="text-gray-900 font-semibold">Order's Total: MYR {{ number_format($orderTotal, 2) }}
                            </p>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endsection
