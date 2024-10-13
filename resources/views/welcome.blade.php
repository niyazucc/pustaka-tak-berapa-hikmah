@extends('layouts.app')

@section('title', 'Pustaka Tak Berapa Hikmah')

@section('content')

    <div class="bg-slate-100 px-4 lg:px-6 py-2.5">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <div class="flex items-center lg:order-2">
                <img src="{{ asset('logo/banner.jpg') }}" class="w-full h-full object-cover block" alt="...">
            </div>
        </div>
    </div>

    {{-- Start Promosi --}}
    <div class="px-4 lg:px-6 py-2.5">
        <div class="items-center mx-auto max-w-screen-xl bg-white space-y-8 px-8 pt-10 pb-10">
            <div class="grid grid-cols-2">
                <div>
                    <h2 class="mb-0 pt-0 text-xl tracking-tight font-bold text-gray-900">Promosi</h2>
                    <h2 class="mt-0 text-gray-700">Dapatkan pelbagai bahan bacaan menarik dengan harga yang berpatutan</h2>
                </div>
                <div class="text-right">
                    <a class="text-red-400 font-semibold" href="#">Lihat Lagi</a>
                </div>
            </div>
            {{-- Swiper container for Promosi --}}
            <div class="swiper promosi-swiper mt-5">
                <div class="swiper-wrapper">
                    @foreach ($ondiscount as $book)
                        <div class="swiper-slide">
                            <x-book-card :book="$book" />
                        </div>
                    @endforeach
                </div>

                {{-- Swiper Navigation --}}
                <div class="swiper-button-next promosi-next text-black"></div>
                <div class="swiper-button-prev promosi-prev text-black"></div>
            </div>

        </div>
    </div>
    {{-- End Promosi --}}


    {{-- Start Keluaran Terbaru --}}
    <div class="bg-slate-100 px-4 lg:px-6 py-2.5">
        <div class="items-center mx-auto max-w-screen-xl px-8 pt-2 pb-10">
            <div class="grid grid-cols-2">
                <div>
                    <h2 class="mb-0 pt-0 text-xl tracking-tight font-bold text-gray-900">Keluaran Terbaru</h2>
                    <h2 class="mt-0 text-gray-700">Senarai buku keluaran terbaru</h2>
                </div>
                <div class="text-right">
                    <a class="text-red-400 font-semibold" href="#">Lihat Lagi</a>
                </div>
            </div>

            {{-- Swiper container for Keluaran Terbaru --}}
            <div class="swiper terbaru-swiper mt-5">
                <div class="swiper-wrapper">
                    @foreach ($latest as $book)
                        <div class="swiper-slide">
                            <x-book-card :book="$book" />
                        </div>
                    @endforeach
                </div>

                {{-- Swiper Navigation --}}
                <div class="swiper-button-next terbaru-next text-black"></div>
                <div class="swiper-button-prev terbaru-prev text-black"></div>
            </div>

        </div>
    </div>
    {{-- End Keluaran Terbaru --}}


    {{-- Start Buku Terlaris --}}
    <div class="bg-white px-4 lg:px-6 py-2.5">
        <div class="items-center mx-auto max-w-screen-xl space-y-8 px-8 pt-2 pb-10">
            <div class="grid grid-cols-2">
                <div>
                    <h2 class="mb-0 pt-0 text-xl tracking-tight font-bold text-gray-900">Buku Terlaris</h2>
                    <h2 class="mt-0 text-gray-700">Dapatkan buku terlaris kami</h2>
                </div>
                <div class="text-right">
                    <a class="text-red-400 font-semibold" href="#">Lihat Lagi</a>
                </div>
            </div>

            {{-- Swiper container for Buku Terlaris --}}
            <div class="swiper terlaris-swiper mt-5">
                <div class="swiper-wrapper">
                    @foreach ($popular as $book)
                        <div class="swiper-slide">
                            <x-book-card :book="$book" />
                        </div>
                    @endforeach
                </div>

                {{-- Swiper Navigation --}}
                <div class="swiper-button-next terlaris-next text-black"></div>
                <div class="swiper-button-prev terlaris-prev text-black"></div>
            </div>

        </div>
    </div>
    {{-- End Buku Terlaris --}}

    <script>
        // Promosi Swiper
        var promosiSwiper = new Swiper('.promosi-swiper', {
            slidesPerView: 5,
            spaceBetween: 30,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.promosi-next',
                prevEl: '.promosi-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                }
            },
            loop: true,
        });

        // Keluaran Terbaru Swiper
        var terbaruSwiper = new Swiper('.terbaru-swiper', {
            slidesPerView: 5,
            spaceBetween: 30,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.terbaru-next',
                prevEl: '.terbaru-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                }
            },
            loop: true,
        });

        // Buku Terlaris Swiper
        var terlarisSwiper = new Swiper('.terlaris-swiper', {
            slidesPerView: 5,
            spaceBetween: 30,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.terlaris-next',
                prevEl: '.terlaris-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                }
            },
            loop: true,
        });
    </script>

@endsection
