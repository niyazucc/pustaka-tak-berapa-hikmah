<?php

namespace App\Livewire\Admin\Discount\Forms;

use Illuminate\Support\Facades\DB;
use App\Models\Book;
use Livewire\Component;
use App\Models\Discount;
use Filament\Forms\Form;
use App\Livewire\BaseForm;
use App\Models\BookDiscount;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class DiscountForm extends BaseForm
{
    public ?BookDiscount $bd = null;
    public ?Discount $discount = null;

    public function mount()
    {
        //Discount
        $this->discount ??= new Discount();
        $this->data = $this->discount->toArray();

        //retrieve bookid
        $existingBookIds = $this->discount->book()->pluck('books.id')->toArray();
        $this->data['book_id'] = $existingBookIds;
        // dd($this->data['book_id']);
        $this->form->fill($this->data);
    }

    public function save()
    {
        $data = $this->form->getState();

        // Update the existing discount or create a new one if it doesn't exist
        $discount = $this->discount ?? new Discount();
        $discount->description = $data['description'];
        $discount->discount_rate = $data['discount_rate'];
        $discount->start_datetime = $data['start_datetime'];
        $discount->end_datetime = $data['end_datetime'];
        $discount->save(); // Save the discount to get its ID if it's a new one

        // Get the selected book IDs
        $bookIds = $data['book_id'] ?? [];
        // foreach ($bookIds as $bookId) {
        //     // Insert into the pivot table (bookdiscount)
        //     DB::table('book_discount')->insert([
        //         'book_id' => $bookId,
        //         'discount_id' => $discount->id,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
        // Sync the selected books with the discount
        $discount->book()->sync($bookIds);

        $this->popupNotification('Success', 'Discount has been applied to the selected books!');
        return to_route('admin.discount');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('book_id')
                ->searchable()
                ->multiple()
                ->options(
                    collect(Book::all())->mapWithKeys(fn(Book $book) => [
                        $book->id => $book->title
                    ])->toArray()
                ),
            TextInput::make('description')->required(),
            TextInput::make('discount_rate')->required()->numeric()
                ->minValue(1)
                ->maxValue(100),
            DatePicker::make('start_datetime')->required(),
            DatePicker::make('end_datetime')->required()
        ])->statePath('data');
    }
}
