<?php

namespace App\Livewire\Admin\Widget;

use App\Models\Book;
use App\Models\OrderItems;
use App\Models\User;
use Livewire\Component;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\LineChartWidget;
use Filament\Widgets\PieChartWidget;

class DashboardWidget extends BaseWidget
{
    // Fetch the total number of paid orders
    public function getOrdersCount()
    {
        return OrderItems::all()->count();
    }

    // Fetch the total number of books in the database
    public function getBookCount()
    {
        return Book::count();
    }

    // Calculate the total revenue from paid orders
    public function getTotalRevenue()
    {
        return OrderItems::all()->sum('total');
    }

    // Calculate the average order value
    public function getAverageOrderValue()
    {
        return OrderItems::all()->avg('total');
    }

    // Fetch the number of registered customers
    public function getCustomerCount()
    {
        return User::where('role', '=', 'customer')->count();
    }

    // Check for books with low stock (e.g., less than 5)
    public function getLowStockCount()
    {
        return Book::where('stockcount', '<', 5)->count();
    }

    public function getSalesTrendData()
    {
        $salesData = OrderItems::all()
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return [
            'labels' => $salesData->pluck('date')->toArray(),
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $salesData->pluck('total')->toArray(),
                    'borderColor' => '#4CAF50',
                    'fill' => false,
                ],
            ],
        ];
    }

    // Fetch book sales data for the distribution chart
    public function getBooksSoldData()
    {
        $bookSales = Book::withCount('orders')->get();

        return [
            'labels' => $bookSales->pluck('title')->toArray(),
            'datasets' => [
                [
                    'label' => 'Books Sold',
                    'data' => $bookSales->pluck('orders_count')->toArray(),
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF5722'],
                ],
            ],
        ];
    }
    // Override the getStats method to display dynamic data
    protected function getStats(): array
    {
        return [
            Stat::make('Total Paid Orders', $this->getOrdersCount())
                ->description('Number of orders marked as Paid')
                ->icon('heroicon-o-shopping-cart'),

            Stat::make('Total Books', $this->getBookCount())
                ->description('Books available in the store')
                ->icon('heroicon-o-book-open'),

            Stat::make('Total Revenue', 'RM' . number_format($this->getTotalRevenue(), 2))
                ->description('Total sales from all paid orders')
                ->icon('heroicon-o-currency-dollar'),

            Stat::make('Average Order Value', 'RM' . number_format($this->getAverageOrderValue(), 2))
                ->description('Average value of paid orders')
                ->icon('heroicon-o-calculator'),

            Stat::make('Total Customers', $this->getCustomerCount())
                ->description('Number of registered customers')
                ->icon('heroicon-o-user-group'),

            Stat::make('Low Stock Alerts', $this->getLowStockCount())
                ->description('Books with stock less than 5')
                ->color($this->getLowStockCount() > 0 ? 'danger' : 'success')
                ->icon('heroicon-o-exclamation-triangle'),
        ];
    }

}
