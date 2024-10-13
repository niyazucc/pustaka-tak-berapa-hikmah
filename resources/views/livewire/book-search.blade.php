<div class="relative">
    <form wire:submit.prevent class="flex items-center max-w-sm mx-auto">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <input type="text" id="simple-search" wire:model.live="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full"
                placeholder="Cari kata kunci atau judul buku" required />
        </div>
        <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-black bg-white rounded-lg ">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>

    <!-- Display search results dropdown -->
    @if ($search)
        <div class="absolute z-10 mt-2 w-full rounded-md shadow-lg bg-white border border-gray-200">
            <ul class="max-h-100 overflow-y-auto">
                @forelse($books as $book)
                <a href="{{route('bookDetails',['id'=>$book->id])}}">
                    <li class="p-2 flex text-gray-800 hover:bg-gray-100 cursor-pointer">
                        <div class="flex-initial w-64">
                            <img src="{{ asset('storage/' . $book->bookimage1) }}" >
                        </div>
                        <div class="flex-initial ml-4 w-64">
                            {{ $book->title }}
                        </div>
                        <div class="flex-initial ml-4 w-64 text-red-500">
                            RM{{ $book->price }}
                        </div>
                    </li>
                </a>
                    @if (!$loop->last)
                        <hr> <!-- Only add hr if it's not the last item -->
                    @endif
                @empty
                    <li class="p-2 text-gray-500">No books found.</li>
                @endforelse
            </ul>
        </div>
    @endif
</div>
