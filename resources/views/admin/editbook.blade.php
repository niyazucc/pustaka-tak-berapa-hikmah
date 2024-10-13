@component('admin.layouts.app')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg">
        <section class="bg-white dark:bg-gray-900">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit book</h2>
                @livewire('create-book', [
                    'book' => $book
                ])
        </section>
    </div>
</div>
@endcomponent
