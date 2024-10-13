@component('admin.layouts.app')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 rounded-lg">
            <h3 class="p-1 text-lg font-sans ">Create Discount</h3>
            <livewire:admin.discount.forms.discount-form />
        </div>
        <div class="p-4 mt-3 border-2 border-gray-200 rounded-lg">
            <h3 class="p-1 text-lg font-sans">List Discount</h3>
            <livewire:admin.discount.tables.list-discount />
        </div>
    </div>
@endcomponent
