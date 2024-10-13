<?php

namespace App\Livewire\Admin\Discount\Forms;

use Livewire\Component;
use App\Models\Discount;
use Filament\Forms\Form;
use App\Livewire\BaseForm;
use App\Models\Book;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class DiscountForm extends BaseForm
{
    public ?Discount $discount = null;

    public function mount()
    {
        $this->discount ??= new Discount();
        $this->data = $this->discount->toArray();
        $this->form->fill($this->data);
    }

    public function save()
    {
        $this->form->getState();
        $this->discount->fill(
            [
                ...$this->data,
            ]
        )->save();
        $this->popupNotification('Berjaya', 'Discount has been saved!');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('book_id')

                ->options(
                    collect(Book::all())->mapWithKeys(fn(Book $book) => [
                        $book->id => $book->title
                    ])->toArray()
                ),
            TextInput::make('description')->required(),
            TextInput::make('discount_rate')->required()->numeric(),
            DatePicker::make('start_datetime')->required(),
            DatePicker::make('end_datetime')->required()
        ])->statePath('data');
    }
}
