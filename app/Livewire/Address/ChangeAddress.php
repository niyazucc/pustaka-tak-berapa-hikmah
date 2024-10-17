<?php

namespace App\Livewire\Address;

use Livewire\Component;
use App\Models\Addresses;
use App\Livewire\BaseForm;

class ChangeAddress extends BaseForm
{
    public ?Addresses $addresses = null;

    public function mount()
    {
        $this->addresses ??= new Addresses();
        $this->data = $this->addresses->toArray();
        $this->form->fill($this->data);
    }

    public function render()
    {
        return view('livewire.address.change-address');
    }
}
