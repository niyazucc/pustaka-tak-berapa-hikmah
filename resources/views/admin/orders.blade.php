@component('admin.layouts.app')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 rounded-lg">
            <h2 class="text-xl font-bold p-2">Orders</h2>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                @livewire('admin.order.table.orders-table')
            </div>
        </div>
    </div>
    @endcomponent

