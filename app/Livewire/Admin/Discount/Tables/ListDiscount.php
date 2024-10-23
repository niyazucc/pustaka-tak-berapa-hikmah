<?php

namespace App\Livewire\Admin\Discount\Tables;

use App\Models\BookDiscount;
use Livewire\Component;
use App\Models\Discount;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Carbon;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;


class ListDiscount extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public ?Discount $discount = null;
    public ?BookDiscount $bd =null;

    public function getDiscountStatus(Discount $discount): string
    {
        $now = Carbon::now();

        if ($now->isBefore($discount->start_datetime)) {
            return 'upcoming';
        } elseif ($now->between($discount->start_datetime, $discount->end_datetime)) {
            return 'ongoing';
        } else {
            return 'passed';
        }
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(Discount::query())
            ->actions([
                Action::make('edit')
                    ->url(fn(Discount $id): string => route('admin.editdiscount', $id)),
                Action::make('delete')
                    ->requiresConfirmation()
                    ->action(fn(Discount $id) => $id->delete())
            ])

            ->columns([
                TextColumn::make('id')->label('Discount ID'),
                TextColumn::make('books') // Use the relationship to get related book IDs
                    ->label('Book IDs')
                    ->getStateUsing(function (Discount $record) {
                        // dd($record);
                        return $record->book()->pluck('books.id')->implode(', ');
                    }),
                TextColumn::make('description')->label('Description')->searchable(),
                TextColumn::make('discount_rate')->label('Discount Rate'),
                TextColumn::make('start_datetime')->label('Start')->since()->dateTimeTooltip(),
                TextColumn::make('end_datetime')->label('End')->since()->dateTimeTooltip(),
                TextColumn::make('status')
                    ->badge() // Make the status a badge
                    ->color(fn(string $state): string => match ($state) {
                        'upcoming' => 'gray',
                        'ongoing' => 'success',
                        'passed' => 'danger',
                    })
                    ->label('Status')

                    ->getStateUsing(fn(Discount $record) => $this->getDiscountStatus($record)),
            ]);
    }
    public function render()
    {
        return view('livewire.admin.discount.tables.list-discount');
    }
}
