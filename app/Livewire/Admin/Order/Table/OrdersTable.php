<?php

namespace App\Livewire\Admin\Order\Table;

use App\Models\Orders;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Livewire\BaseTable;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class OrdersTable extends BaseTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public ?Orders $order = null;

    public function table(Table $table): Table
    {

        return $table
            ->recordUrl(
                fn(Orders $orders): string => route('admin.order-details', ['id' => $orders->id]),
            )
            ->query(Orders::query())
            ->filters([
                Filter::make('paid')->label('Paid')
                    ->query(fn(Builder $query): Builder => $query->where('orderstatus', 'Paid')),
                Filter::make('to_shipping')->label('Shipping')
                    ->query(fn(Builder $query): Builder => $query->where('orderstatus', 'Shipping')),
                Filter::make('completed')->label('Completed')
                    ->query(fn(Builder $query): Builder => $query->where('orderstatus', 'Completed'))
            ])->columns([
                TextColumn::make('id')->label('Order ID')->searchable(),
                TextColumn::make('users.name')->label('Nama Pelanggan')->searchable(),
                TextColumn::make('created_at')->label('Dibayar Pada')->since()->dateTimeTooltip(),
                TextColumn::make('orderstatus')
                    ->badge() // Make the status a badge
                    ->color(fn(string $state): string => match ($state) {
                        'Paid' => 'warning',
                        'Shipping' => 'gray',
                        'Completed' => 'success',
                    })
                    ->label('Status'),
            ]);
    }
    public function render()
    {
        return view('livewire.admin.order.table.orders-table');
    }
}
