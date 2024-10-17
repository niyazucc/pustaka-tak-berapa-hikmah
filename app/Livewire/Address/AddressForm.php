<?php

namespace App\Livewire\Address;

use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Addresses;
use App\Livewire\BaseForm;
use Filament\Forms\Components\TextInput;

class AddressForm extends BaseForm
{
    public ?Addresses $addresses = null;

    public function mount()
    {
        $this->addresses ??= new Addresses();
        $this->data = $this->addresses->toArray();
        $this->form->fill($this->data);
    }

    public function save()
    {
        $this->form->getState();
        $this->data['customer_id'] = auth()->user()->id;
        $this->addresses->fill($this->data)->save();
        $this->popupNotification('Successful', 'Address has been saved!');
    }
    public function form(Form $form): Form
    {
        return $form->columns([
            'sm' => 3,
            'xl' => 6,
            '2xl' => 8,
        ])->schema([
            TextInput::make('name')
                ->required()
                ->columnSpan(2), // Adjust as needed
            TextInput::make('phone_number')
                ->required()
                ->maxLength(11)
                ->columnSpan(2), // Adjust as needed
            TextInput::make('address')
                ->required()
                ->columnSpan(4), // Adjust as needed
            TextInput::make('city')
                ->required()
                ->columnSpan(2), // Adjust as needed
            TextInput::make('state')
                ->required()
                ->columnSpan(2), // Adjust as needed
            TextInput::make('zip')
                ->required()
                ->columnSpan(1), // Adjust as needed
            TextInput::make('country')
                ->required()
                ->columnSpan(3), // Adjust as needed
        ])->statePath('data');
    }

}
