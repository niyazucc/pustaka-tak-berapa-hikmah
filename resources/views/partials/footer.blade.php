{{-- start footer hitam --}}
<footer class="bg-black px-4 lg:px-6 py-2.5 mt-10">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <!-- Left Section: Logo and Contact Info -->
        <div class="flex items-center">
            <a href="/" class="flex items-center">
                <img src="{{ asset('logo/jmknns.svg') }}" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
            </a>
            <div class="text-white font-semibold pl-4">
                <p>Hubungi Kami:</p>
                <p>Email: contact@example.com</p>
                <p>Telefon: +60 123-456-789</p>
            </div>
            <div class="text-white font-semibold pl-4">
                <ul class="flex flex-col mx-auto max-w-screen-xl mt-2 ">
                    <li class="text-sm hover:text-red-400"><a href="#">Semua Kategori</a></li>
                    <li class="text-sm hover:text-red-400"><a href="#">Promosi</a></li>
                    <li class="text-sm hover:text-red-400"><a href="#">Keluaran Terbaru</a></li>
                    <li class="text-sm hover:text-red-400"><a href="#">Buku Terlaris</a></li>
                    <li class="text-sm hover:text-red-400"><a href="#">Dokumen Terbitan</a></li>
                </ul>
            </div>
        </div>

        <!-- Center Section: Follow Us & Social Media Icons -->
        <div class="flex items-center lg:order-2">
            <div class="text-white font-semibold mr-4">Ikuti kami di</div>
            <a href="#" class="text-white">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z"
                        clip-rule="evenodd" />
                </svg>
            </a>
            <a href="#" class="text-white ml-4">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
                        clip-rule="evenodd" />
                </svg>
            </a>
            <a href="#" class="text-white ml-4">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path d="M22.54 6.42a8.12 8.12 0 0 1-2.33.64 4.05 4.05 0 0 0 1.78-2.24 8.19 8.19 0 0 1-2.59.99A4.09 4.09 0 0 0 16 4a4.08 4.08 0 0 0-4.07 4.07c0 .32.04.63.1.93a11.58 11.58 0 0 1-8.41-4.25 4.09 4.09 0 0 0 1.27 5.43 4.07 4.07 0 0 1-1.85-.51v.05A4.08 4.08 0 0 0 7.3 14a4.09 4.09 0 0 1-1.08.15c-.27 0-.53-.03-.79-.08A4.09 4.09 0 0 0 9.16 16c-2.72 2.13-6.14 2.73-9.32 2-.59-.1-.52.64-.52.64a11.58 11.58 0 0 0 6.28 1.84c7.54 0 11.67-6.25 11.67-11.67 0-.18 0-.36-.01-.54A8.31 8.31 0 0 0 24 4.5c-.79.35-1.65.58-2.53.67a4.13 4.13 0 0 0 1.8-2.27Z" />
                </svg>
            </a>
        </div>

        <!-- Right Section: Links -->
        <div class="flex flex-wrap justify-end mt-4 lg:mt-0">

        </div>
    </div>

    <!-- Bottom Section: Copyright -->
    <div class="text-center text-white mt-6">
        &copy; {{ date('Y') }} PustakaHikmahXD. All Rights Reserved.
    </div>
</footer>
