@component('admin.layouts.app')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 rounded-lg">
            @if ($discount)
            <h3 class="text-xl font-bold p-2">Edit Discount</h3>
            @else
            <h3 class="text-xl font-bold p-2">Create Discount</h3>
            @endif
            @livewire('admin.discount.forms.discount-form', ['discount' =>$discount])
        </div>
    </div>
@endcomponent
