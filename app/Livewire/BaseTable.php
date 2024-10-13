<?php

namespace App\Livewire;
use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use App\Traits\NotificationTrait;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class BaseTable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use NotificationTrait;

    public ?array $data = [];
    
    public function render()
    {
        return view('livewire.base-table');
    }
}
