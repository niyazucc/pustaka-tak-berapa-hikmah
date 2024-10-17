<?php

namespace App\Livewire\Admin\Discount\Tables;

use Livewire\Component;
use App\Models\Discount;
use Filament\Tables\Table;
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
            ->columns([
                TextColumn::make('book_id')->label('Book ID'),
                TextColumn::make('description')->label('Description')->searchable(),
                TextColumn::make('discount_rate')->label('Discount Rate'),
                TextColumn::make('start_datetime')->label('Start'),
                TextColumn::make('end_datetime')->label('End'),
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
