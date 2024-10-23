<div class="w-full max-w-sm rounded-lg  ">
    <a href="{{ route('bookDetails', ['id' => $book->id]) }}">
        <img class="static object-fill h-60 w-96" src="{{ asset('storage/' . $book->bookimage1) }}" alt="product image" />
        @if ($book->discounts->isNotEmpty())
            <h5 class="absolute text-white bg-red-500 top-0 right-0 py-1 px-1 shadow-md">
                -{{ $book->discounts->first()->discount_rate }}
                %
            </h5>
        @endif
    </a>

    <div class="px-1 ">
        <a href="{{ route('bookDetails', ['id' => $book->id]) }}">
            <h5 class="tracking-tight text-black mb-4 hover:underline underline-offset-1">{{ $book->title }}</h5>
        </a>

        <div class="grid">
            @if ($book->discounts->isNotEmpty())
                <span class="text-xl font-bold text-black mb-4">RM
                    {{ $book->price * (1 - ($book->discounts->first()->discount_rate / 100)) }} <span
                        class="text-lg font-bold text-gray-400 mb-4 line-through">RM {{ $book->price }}</span></span>
            @else
                <span class="text-xl font-bold text-black mb-4">RM {{ $book->price }}</span>
            @endif

            @if ($book->discounts->isNotEmpty())
                @livewire('addtocart', [
                    'bookid' => $book->id,
                    'quantity' => 1,
                    'price' => $book->price * (1 - ($book->discounts->first()->discount_rate / 100)),
                ])
            @else
                @livewire('addtocart', [
                    'bookid' => $book->id,
                    'quantity' => 1,
                    'price' => $book->price,
                ])
            @endif
        </div>
    </div>
</div>
