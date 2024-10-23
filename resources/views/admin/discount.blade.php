@component('admin.layouts.app')
    <div class="p-4 sm:ml-64">

        <div class="p-4 border-2 border-gray-200 rounded-lg">
            <h2 class="text-xl font-bold p-2">List Discounts</h2>
            <button type="button"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 "
                onclick="window.location.href='{{ route('admin.creatediscount') }}'">Create new discount</button>
            <livewire:admin.discount.tables.list-discount />
        </div>
    </div>
@endcomponent
