@component('admin.layouts.app')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 rounded-lg">
            <section class="bg-white dark:bg-gray-900">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                    @if (isset($book->id))
                        Edit Book
                    @else
                        Add New Book
                    @endif
                </h2>
                <form method="POST" action="{{ isset($book->id) ? route('admin.update', $book->id) : route('admin.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if (isset($book->id))
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $book->id }}">
                    @else
                        @method('POST')
                    @endif
                    <x-validation-errors />

                    <div class="px-4 mx-auto ">
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                <input type="text" name="title" id="title" value="{{ $book->title }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter book title">
                            </div>
                            <div class="w-full">
                                <label for="author"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author</label>
                                <input type="text" name="author" id="author" value="{{ $book->author }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter author's name" required>
                            </div>
                            <div class="w-full">
                                <label for="publisher"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publisher</label>
                                <input type="text" name="publisher" id="publisher" value="{{ $book->publisher }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter publisher name" required>
                            </div>
                            <div class="w-full">
                                <label for="price"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price
                                    (RM)</label>
                                <input type="number" name="price" id="price" value="{{ $book->price }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter price" required>
                            </div>
                            <div>
                                <label for="weight"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight
                                    (g)</label>
                                <input type="number" name="weight" id="weight" value="{{ $book->weight }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter book weight" required>
                            </div>
                            <div class="w-full">
                                <label for="page"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Page
                                    Count</label>
                                <input type="number" name="page" id="page" value="{{ $book->page }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter page count" required>
                            </div>
                            <div class="w-full">
                                <label for="chapter"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chapter</label>
                                <input type="text" name="chapter" id="chapter" value="{{ $book->chapter }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter chapter details" required>
                            </div>
                            <div class="w-full">
                                <label for="isbn"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ISBN</label>
                                <input type="text" name="isbn" id="isbn" value="{{ $book->isbn }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter ISBN number" required>
                            </div>
                            <div class="w-full">
                                <label for="stockcount"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock
                                    Count</label>
                                <input type="number" name="stockcount" id="stockcount" value="{{ $book->stockcount }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter stock count" required>
                            </div>
                            <div class="w-full">
                                <label for="publishyear"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publish
                                    Year</label>
                                <input type="number" name="publishyear" id="publishyear" value="{{ $book->publishyear }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Enter publish year" required>
                            </div>
                            <div class="w-full">
                                <label for="language"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Language</label>
                                <select name="language" id="language"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" disabled>Please select language</option>
                                    <option value="Bahasa Melayu">Bahasa Melayu</option>
                                    <option value="Bahasa Inggeris">Bahasa Inggeris</option>
                                    <option value="DwiBahasa">DwiBahasa</option>
                                </select>
                            </div>
                            <div class="w-full col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Current Categories:
                                    <div class="flex space-x-2">
                                        @if ($currentCategories->isNotEmpty())
                                            @foreach ($currentCategories as $cat)
                                                <button class="bg-gray-200 text-gray-800 rounded px-2 py-1">
                                                    {{ $cat->description }}
                                                </button>
                                            @endforeach
                                        @else
                                            <button class="bg-gray-200 text-gray-800 rounded px-2 py-1">
                                                No category has been assigned to this book.
                                            </button>
                                        @endif

                                    </div>
                                </label>
                            </div>

                            <div class="w-full col-span-2">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories</label>
                                <select multiple name="category[]" id="category"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="" disabled>Please select book category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($currentCategories->contains($category)) selected @endif>
                                            {{ $category->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-center mb-4">
                                <input name="isnew" type="checkbox" value="1"
                                    @if ($book->isnew == 1) checked @endif
                                    class="w-4 h-4 text-black bg-gray-100 border-gray-300 rounded focus:ring-black ">
                                <label for="default-checkbox"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is
                                    New</label>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="synopsis"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Synopsis</label>
                                <textarea name="synopsis" id="synopsis" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="@if ($book->synopsis) {{ $book->synopsis }}@else Enter book synopsis @endif"></textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="bookimage1">Book Image 1</label>
                                @if (isset($book->bookimage1))
                                    <img src="{{ asset('storage/' . $book->bookimage1) }}" alt="Current Image"
                                        class="w-32 h-32">
                                @endif
                                <input type="file" name="bookimage1" id="bookimage1"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="bookimage2">Book Image 2</label>
                                @if ($book->bookimage2 != null or $book->bookimage2 != '')
                                    <img src="{{ asset('storage/' . $book->bookimage2) }}" alt="Current Image"
                                        class="w-32 h-32">
                                @endif
                                <input type="file" name="bookimage2" id="bookimage2"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="bookimage3">Book Image 3</label>
                                @if ($book->bookimage3 != null or $book->bookimage3 != '')
                                    <img src="{{ asset('storage/' . $book->bookimage3) }}" alt="Current Image"
                                        class="w-32 h-32">
                                @endif
                                <input type="file" name="bookimage3" id="bookimage3"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            </div>

                        </div>
                        <a class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-gray-400 rounded-lg "
                            href="{{ route('admin.listbook') }}">Cancel</a>
                        <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-black rounded-lg ">
                            @if (isset($book->id))
                                Update Book
                            @else
                                Create Book
                            @endif
                        </button>

                    </div>
                </form>
            </section>
        </div>
    </div>
@endcomponent
