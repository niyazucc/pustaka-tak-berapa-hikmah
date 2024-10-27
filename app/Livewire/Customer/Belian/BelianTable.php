<?php

namespace App\Livewire\Customer\Belian;


use App\Models\Orders;
use Livewire\Component;
use Stripe\Climate\Order;
use Filament\Tables\Table;
use App\Livewire\BaseTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class BelianTable extends BaseTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public ?Orders $orders = null;

    public function table(Table $table): Table
    {
        return $table
            ->recordUrl(
                fn(Orders $orders): string => route('customer.view-order-details', ['orders_id' => $orders->id]),
            )
            ->filters([
                Filter::make('paid')->label('Paid')
                    ->query(fn(Builder $query): Builder => $query->where('orderstatus', 'Paid')),
                Filter::make('to_receive')->label('To Receive')
                    ->query(fn(Builder $query): Builder => $query->where('orderstatus', 'To Receive')),
                Filter::make('completed')->label('Completed')
                    ->query(fn(Builder $query): Builder => $query->where('orderstatus', 'Completed'))
            ])
            ->query(
                Orders::where('customer_id', auth()->user()->id)
                // Eager load order items and their associated books
            )
            ->columns([
                TextColumn::make('id')->label('Order ID')->searchable(),
                TextColumn::make('orderitems.book.title')->label('Buku')->searchable(),
                // TextColumn::make('orderitems.total')
                //     ->money('MYR')->label('Harga'),
                TextColumn::make('orderitems.total')
                    ->label('Harga')
                    ->formatStateUsing(function ($record) {
                        $state = $this->getOrderTotal($record); // Pass $record to getOrderTotal
                        $state = number_format($state, 2);
                        return $state;
                    })
                    ->prefix('MYR '),
                TextColumn::make('created_at')
                    ->label('Beli Pada')->sortable()
                    ->dateTime('d M Y, h:i A'), // Formatting the timestamp
                TextColumn::make('orderstatus')
                    ->badge()->label('Status')
                    ->color(fn(string $state): string => match ($state) {
                        'Paid' => 'gray',
                        'Shipping' => 'success',
                        'Complete' => 'success',
                        default => 'warning',
                    }),

            ]);
    }
    protected function getOrderTotal(?Orders $order): string
    {
        // Ensure $order is not null before accessing its properties
        if ($order && $order->name !== 'Pickup Location') {
            return $order->orderitems->sum('total') + 5;
        }

        // Return the sum if $order is not null, otherwise return '0.00'
        return $order ? $order->orderitems->sum('total') : '0.00';
    }

    public function render()
    {
        return view('livewire.customer.belian.belian-table');
    }
}
