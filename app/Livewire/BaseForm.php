<?php

namespace App\Livewire;

use App\Traits\NotificationTrait;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class BaseForm extends Component implements HasActions, HasForms
{
    use InteractsWithForms, InteractsWithActions;
    use NotificationTrait;

    public ?array $data = [];

    public function render()
    {
        return view('livewire.base-form');
    }
}
