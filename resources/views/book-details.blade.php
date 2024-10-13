@extends('layouts.app')

@section('title', 'Pustaka Tak Berapa Hikmah')

@section('content')
    <section class="py-8 bg-slate-50 md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">

                <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">

                    <img class="w-80 dark:hidden" src="{{ asset('storage/' . $book->bookimage1) }}" />
                    <div class="pt-2 flex gap-2">

                        <img class="w-16 cursor-pointer" src="{{ asset('storage/' . $book->bookimage1) }}"
                            alt="Book Preview 1" />
                        @if ($book->bookimage2)
                            <img class="w-16 cursor-pointer" src="{{ asset('storage/' . $book->bookimage2) }}"
                                alt="Book Preview 2" />
                        @endif
                        @if ($book->bookimage3)
                            <img class="w-16 cursor-pointer" src="{{ asset('storage/' . $book->bookimage3) }}"
                                alt="Book Preview 3" />
                        @endif
                    </div>

                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $book->title }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-2xl font-extrabold text-red-500 sm:text-3xl dark:text-white">
                            RM{{ $book->price }}
                        </p>
                    </div>

                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <form>
                            <label for="quantity-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity:</label>
                            <div class="relative flex items-center max-w-[8rem]">
                                <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>
                                <input type="text" id="quantity-input" data-input-counter data-input-counter-min="1"
                                    data-input-counter-max="{{ $book->stockcount }}"
                                    aria-describedby="helper-text-explanation"
                                    class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="" value="1" required />
                                <button type="button" id="increment-button" data-input-counter-increment="quantity-input"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                            <label for="quantity-input"
                                class="block mt-2 mb-2 text-sm font-medium text-gray-900 dark:text-white">Stocks:
                                {{ $book->stockcount }}</label>

                        </form>
                    </div>

                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <div class="grid px-4 bg-red-600 hover:bg-red-400">
                            @livewire('addtocart', [
                                'bookid' => $book->id,
                                'quantity' => 1,
                                'price' => $book->price,
                            ])
                        </div>



                        <a href="#" title=""
                            class="text-white bg-black font-bold text-sm  py-2.5 text-center mt-4 sm:mt-0 focus:ring-4 focus:ring-primary-300  px-5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                            role="button">
                            Beli Sekarang
                        </a>
                    </div>

                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                    <p class="mt-6 text-gray-500 dark:text-gray-400">
                        {{ $book->synopsis }}
                    </p>

                </div>
            </div>
        </div>
    </section>
    <section class="bg-white mx-auto max-w-screen-xl px-4 py-8">
        <div class="grid grid-cols-3">
            <div class="col-span-3 max-w-screen-xl px-4 ">
                <h2 class="text-xl font-semibold text-red-500 dark:text-white sm:text-2xl">Synopsis</h2>

                <p>Tahun Terbitan: {{ $book->publishyear }}</p>
                <p>ISBN: {{ $book->isbn }}</p>
                <p>Bil. Muka Surat: {{ $book->page }} muka surat</p>
                <p>Berat: {{ $book->isbn }}g</p>

                @if ($book->synopsis)
                    <h3><b>Sinopsis</b></h3>
                    <p>{{ $book->synopsis }}</p>
                @endif
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Categories:
                        @if ($currentCategories->isNotEmpty())
                            @foreach ($currentCategories as $cat)
                                <button class="bg-red-500 text-white px-2 py-1">
                                    {{ $cat->description }}
                                </button>
                            @endforeach
                        @endif

                </label>
            </div>
            {{-- start review --}}
            <div class="col-span-3 max-w-screen-xl px-4">
                <div class="mx-auto max-w-screen-xl">
                    <div class="mx-auto pt-4">
                        <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                            <h2 class="text-xl font-semibold text-red-500 dark:text-white sm:text-2xl">Reviews</h2>
                            <div class="mt-6 sm:mt-0">
                                <label for="order-type"
                                    class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
                                    review type</label>
                                <select id="order-type"
                                    class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                    <option selected>All reviews</option>
                                    <option value="5">5 stars</option>
                                    <option value="4">4 stars</option>
                                    <option value="3">3 stars</option>
                                    <option value="2">2 stars</option>
                                    <option value="1">1 star</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 flow-root sm:mt-8">
                            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                {{-- start one review  --}}
                                <div class="grid md:grid-cols-12 gap-4 md:gap-6 pb-4 md:pb-6">
                                    <dl class="md:col-span-3 order-3 md:order-1">
                                        <dt class="sr-only">Product:</dt>
                                        <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                            <a href="#" class="hover:underline">Apple iMac 27", M2 Max CPU 1TB
                                                HDD, Retina 5K </a>
                                        </dd>
                                    </dl>

                                    <dl class="md:col-span-6 order-4 md:order-2">
                                        <dt class="sr-only">Message:</dt>
                                        <dd class=" text-gray-500 dark:text-gray-400">It’s fancy, amazing keyboard,
                                            matching accessories. Super fast, batteries last more than usual, everything
                                            runs perfect in this...</dd>
                                    </dl>

                                    <div
                                        class="md:col-span-3 content-center order-1 md:order-3 flex items-center justify-between">
                                        <dl>
                                            <dt class="sr-only">Stars:</dt>
                                            <dd class="flex items-center space-x-1">
                                                <svg class="w-5 h-5 text-yellow-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                                    </path>
                                                </svg>
                                                <svg class="w-5 h-5 text-yellow-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                                    </path>
                                                </svg>
                                                <svg class="w-5 h-5 text-yellow-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                                    </path>
                                                </svg>
                                                <svg class="w-5 h-5 text-yellow-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                                    </path>
                                                </svg>
                                                <svg class="w-5 h-5 text-yellow-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                                    </path>
                                                </svg>
                                            </dd>
                                        </dl>
                                        <button id="actionsMenuDropdown1" data-dropdown-toggle="dropdownOrder1"
                                            type="button"
                                            class="inline-flex h-7 w-7 items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <span class="sr-only"> Actions </span>
                                            <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="4"
                                                    d="M6 12h.01m6 0h.01m5.99 0h.01"></path>
                                            </svg>
                                        </button>
                                        <div id="dropdownOrder1"
                                            class="z-10 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                                            data-popper-placement="bottom">
                                            <ul class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400"
                                                aria-labelledby="actionsMenuDropdown1">
                                                <li>
                                                    <button type="button" data-modal-target="editReviewModal"
                                                        data-modal-toggle="editReviewModal"
                                                        class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        <svg class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                        </svg>
                                                        <span>Edit review</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" data-modal-target="deleteReviewModal"
                                                        data-modal-toggle="deleteReviewModal"
                                                        class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-500">
                                                        <svg class="me-1.5 h-4 w-4" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z">
                                                            </path>
                                                        </svg>
                                                        Delete review
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                {{-- end one review  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection
