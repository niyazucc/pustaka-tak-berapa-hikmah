@extends('layouts.app')
@section('title', 'Order has been placed!')

@section('content')
<section class="py-4 md:py-8 dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <!-- Order Details -->
        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-900">Order Details: #{{ $orders->id }}</h2>
            <h2 class="text-xl font-bold text-gray-900">{{ $orders->orderstatus }}</h2>
        </div>

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
                @foreach ($orders->orderitems as $item)
                    <li class="py-4 flex justify-between">
                        <div>
                            <a href="{{route('bookDetails',['id'=>$item->book->id])}}" class="font-medium text-gray-900">{{ $item->book->title ?? 'Unknown Book' }}</a>
                            <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                        </div>
                        <div>
                            <p class="text-gray-900 font-semibold">Price: MYR {{ number_format($item->price, 2) }}</p>
                            <p class="text-gray-500">Total: MYR {{ number_format($item->total, 2) }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection
