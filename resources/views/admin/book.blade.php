@component('admin.layouts.app')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 rounded-lg">
            <h2 class="text-xl font-bold p-2">List books</h2>
            <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 " onclick="window.location.href='{{ route('admin.create') }}'">Add New Book</button>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price (RM)
                            </th>

                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    <img class="object-fill  h-20 w-20" src="{{ asset('storage/' . $book->bookimage1) }}" alt="">
                                </td>
                                <td class="px-6 py-4">
                                    {{$book->title}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$book->price}}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.edit', $book->id) }}"
                                        class="font-medium text-blue-600 hover:underline">Edit</a>
                                        @livewire('delete-book', ['id' => $book->id], key($book->id))
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @endcomponent

