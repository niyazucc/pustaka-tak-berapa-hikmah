@extends('layouts.app')
@section('title', 'Cart Aku')

@section('content')
    <section class="py-8 antialiased md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

            {{-- Start Address --}}
            <h2 class="text-xl pb-4 font-semibold text-gray-900 dark:text-white sm:text-2xl">
                Alamat Ku
            </h2>
            <div class="shadow rounded-sm ">
                @if (auth()->user()->addresses)
                    <!-- User has at least one address -->
                    <div class="col-span-1 py-2 px-2 font-bold text-left">
                        {{ auth()->user()->addresses->first()->name }}
                    </div>
                    <div class="col-span-2 py-2 px-2">
                        <!-- Display the first address -->
                        <p>{{ auth()->user()->addresses->first()->address }}</p>
                        <p>{{ auth()->user()->addresses->first()->phone_number }}</p>
                    </div>
                    <div class="col-span-1 py-2 px-2 text-right">
                        <button class="underline underline-offset-1" data-modal-toggle="changeAddressModal"
                            data-modal-target="changeAddressModal">Change
                            Address</button>
                    </div>
                @else
                    <!-- No addresses found -->
                    <div class="col-span-4 py-6 px-2 text-center">
                        <p class="pb-2">You don't have any saved addresses. Please add a new address.</p>
                        <button id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                            class="bg-red-500 hover:bg-red-400 text-white py-2 px-4 rounded">Add New Address</button>
                    </div>
                @endif
                <!-- Change Address Modal -->
                <div id="changeAddressModal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                            <!-- Modal header -->
                            <div
                                class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Change Address
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="changeAddressModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="mt-5">
                                @livewire('address.address-form',['addresses'=>auth()->user()->addresses->first()   ])
                            </div>
                        </div>
                    </div>
                </div>
                <div id="defaultModal" tabindex="-1" aria-hidden="true"
                    class="hidden fixed inset-0 z-50  justify-center items-center w-full p-4 ">
                    <div class="relative w-full max-w-2xl bg-white rounded-lg shadow dark:bg-gray-800">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                            <!-- Modal header -->
                            <div class="flex justify-between items-center p-4 rounded-t border-b dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Add Address
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="defaultModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="py-2 px-8">
                                <livewire:address.address-form />
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <script>
                function changeAddress(addressId) {
                    // Handle address change logic here, like setting the selected address in the session or submitting a form.
                    console.log("Address changed to ID:", addressId);
                }
            </script>

            <h2 class="text-xl pt-4 pb-4 font-semibold text-gray-900 dark:text-white sm:text-2xl">Troli Ku</h2>

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
                {{-- End Cart --}}



                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    @livewire('cart.order-summary')
                </div>

            </div>
        </div>
    </section>

@endsection
