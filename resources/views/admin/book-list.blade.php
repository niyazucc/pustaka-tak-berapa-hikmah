@component('admin.layouts.app')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 rounded-lg">
            <h2 class="text-xl font-bold p-2">List books</h2>
            <button type="button"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 "
                onclick="window.location.href='{{ route('admin.create') }}'">Add New Book</button>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                {{-- table book --}}
                @livewire('admin.book.tables.book-table')
            </div>
        </div>
    </div>
@endcomponent
