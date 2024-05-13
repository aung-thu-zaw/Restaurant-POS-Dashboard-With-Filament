<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalOrders = Order::whereYear('created_at', now()->year)->count();

        return [
            Stat::make('Total Products', Product::count())
                ->description('Total products available in this POS.')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('primary')
                ->chart([1, 2, 3, 4, 5, 10, 5]),

            Stat::make('Total Cashiers', User::where("role", "cashier")->count())
                ->description('Total number of cashiers in this POS.')
                ->descriptionIcon('heroicon-o-user')
                ->color('info')
                ->chart([1, 2, 3, 4, 5, 10, 5]),

            Stat::make('Total Orders', $totalOrders)
                ->description('Total orders for the year.')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('warning')
                ->chart([1, 2, 3, 4, 5, 10, 5]),
        ];
    }
}
