@component('admin.layouts.app')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg">
       <div class="grid grid-cols-3 gap-4 mb-4">
          @livewire('admin.widget.dashboard-widget')
       </div>
    </div>
 </div>
@endcomponent
