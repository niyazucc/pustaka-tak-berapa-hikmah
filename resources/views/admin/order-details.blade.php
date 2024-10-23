@component('admin.layouts.app')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 rounded-lg">
            <h2 class="text-xl font-bold p-2">Order Details: {{$order->id}}</h2>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('admin.orders.updateTracking', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="min-w-full bg-white border border-gray-200">
                        <tbody>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">Customer ID</th>
                                <td class="px-6 py-4 text-sm text-gray-700">{{$order->customer_id}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">Tracking Number</th>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <input type="text" required name="trackingno" value="{{ $order->trackingno }}" class="border border-gray-300 p-2 rounded-md w-full">
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">Name</th>
                                <td class="px-6 py-4 text-sm text-gray-700">{{$order->name}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">Address</th>
                                <td class="px-6 py-4 text-sm text-gray-700">{{$order->address}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">City</th>
                                <td class="px-6 py-4 text-sm text-gray-700">{{$order->city}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">State</th>
                                <td class="px-6 py-4 text-sm text-gray-700">{{$order->state}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">ZIP Code</th>
                                <td class="px-6 py-4 text-sm text-gray-700">{{$order->zip}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">Country</th>
                                <td class="px-6 py-4 text-sm text-gray-700">{{$order->country}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">Phone Number</th>
                                <td class="px-6 py-4 text-sm text-gray-700">{{$order->phone_number}}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">Order Status</th>
                                <td class="px-6 py-4 text-sm text-gray-700">{{$order->orderstatus}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="my-2 mx-2">
                        <button type="submit" class="bg-black hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                            Update Tracking Number
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcomponent
