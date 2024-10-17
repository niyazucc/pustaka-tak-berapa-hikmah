{{-- start nav hitam --}}
<nav class="bg-black px-4 lg:px-6 py-2.5">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <a href="/" class="flex items-center">
            <img src="{{ asset('logo/jmknns.svg') }}" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />

        </a>
        <div class="flex items-center lg:order-2">
            <div class="text-white font-semibold">Ikuti kami di</div>
            <svg class="w-6 h-6 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z"
                    clip-rule="evenodd" />
            </svg>
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path fill="currentColor" fill-rule="evenodd"
                    d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
                    clip-rule="evenodd" />
            </svg>

            {{-- check --}}
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a href="{{ route('profile.show') }}" class="text-white pl-4 p-2 font-semibold">
                            Akaun
                        </a>
                        <a href="{{route('customer.belian')}}" class="text-white pl-4 p-2 font-semibold">
                            Belian
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a href="#" class="text-white pl-4 p-2 font-semibold"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log out
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="text-white pl-4 p-2 font-semibold">
                            Daftar Akaun
                        </a>
                        <a href="{{ route('login') }}" class="text-white p-2 font-semibold">
                            Log Masuk
                        </a>

                    @endauth
                </nav>
            @endif

        </div>

    </div>
</nav>
{{-- end nav hitam --}}
{{-- start cart --}}
<nav class="bg-white px-4 lg:px-6 py-2.5  shadow-md">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <a href="/" class="flex items-center">
            <img src="{{ asset('logo/logomufti.png') }}" class="mr-3 h-12" alt="Flowbite Logo" />
        </a>
        <div class="flex items-center lg:order-2">
            @livewire('book-search')
            <a href="{{ route('customer.view') }}"
                class="relative flex items-center space-x-2 bg-white text-black px-4 py-2 font-semibold">
                <svg class="w-6 h-6 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                </svg>
                <span>Troli
                </span>
                @livewire('cart.cart-quantity')
            </a>

        </div>

    </div>
    <ul class="flex mx-auto max-w-screen-xl gap-5 mt-2 ">
        <div x-data="{ open: false }">
            <li class="text-sm hover:text-red-400">
                <button x-on:click="open = !open">Semua Kategori</button>
            </li>
            <aside x-show.important="open" @click.outside="open = false" id="default-sidebar"
                class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
                aria-label="Sidenav">
                <div
                    class="overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <ul class="space-y-2">
                        @if (isset($categories) && $categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <li>
                                    <a href="#"
                                        class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                        <span
                                            class="rounded-full  bg-gray-300 text-black py-1 px-3">{{ $category->books_count }}</span>
                                        <span class="ml-3">{{ $category->description }}</span>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </aside>
        </div>

        <li class="text-sm hover:text-red-400">
            <a href="{{ route('books.byType', 'promosi') }}">Promosi</a>
        </li>
        <li class="text-sm hover:text-red-400">
            <a href="{{ route('books.byType', 'keluaran-terbaru') }}">Keluaran Terbaru</a>
        </li>
        <li class="text-sm hover:text-red-400">
            <a href="{{ route('books.byType', 'buku-terlaris') }}">Buku Terlaris</a>
        </li>

    </ul>


</nav>
{{-- end cart --}}
