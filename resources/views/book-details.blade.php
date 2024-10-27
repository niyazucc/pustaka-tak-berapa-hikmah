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
                        @if ($book->discounts->isNotEmpty())
                            <p class="text-2xl font-extrabold text-red-500 sm:text-3xl dark:text-white">
                                RM{{ $book->price * (1 - $book->discounts->first()->discount_rate / 100) }}
                            </p>
                            <p class="text-xl font-extrabold line-through text-gray-500 sm:text-xl dark:text-white">
                                RM{{ $book->price }}
                            </p>
                        @else
                            <p class="text-2xl font-extrabold text-red-500 sm:text-3xl dark:text-white">
                                RM{{ $book->price }}
                            </p>
                        @endif
                    </div>

                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <form action="{{ route('customer.addtocart') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <input type="hidden" name="price"
                                value="{{ $book->discounts->isNotEmpty() ? $book->price * (1 - $book->discounts->first()->discount_rate / 100) : $book->price }}">
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
                                <input type="text" name="quantity" id="quantity-input" data-input-counter data-input-counter-min="1"
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

                            <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                                <div class="grid px-4 bg-red-600 hover:bg-red-400">
                                    <button type="submit"
                                        class="text-white bg-red-600 hover:bg-red-400 font-bold text-sm  py-2.5 text-center">
                                        Tambah ke Troli
                                    </button>
                                </div>
                                <a href="#" title=""
                                    class="text-white bg-black font-bold text-sm  py-2.5 text-center mt-4 sm:mt-0 focus:ring-4 focus:ring-primary-300  px-5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                                    role="button">
                                    Beli Sekarang
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

            <p class="mt-6 text-gray-500 dark:text-gray-400">
                {{ $book->synopsis }}
            </p>
        </div>
    </section>
    <section class="bg-white mx-auto max-w-screen-xl px-4 py-8">
        <div class="grid grid-cols-3">
            <div class="col-span-3 max-w-screen-xl px-4 ">
                <h2 class="text-xl font-semibold text-red-500 dark:text-white sm:text-2xl">Synopsis</h2>

                <p>Tahun Terbitan: {{ $book->publishyear }}</p>
                <p>ISBN: {{ $book->isbn }}</p>
                <p>Bil. Muka Surat: {{ $book->page }} muka surat</p>
                <p>Berat: {{ $book->weight }}g</p>

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
        </div>
    </section>
@endsection
