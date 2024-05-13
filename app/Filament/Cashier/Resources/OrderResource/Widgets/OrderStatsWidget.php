<?php

namespace App\Filament\Cashier\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class OrderStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Monthly Orders', $this->queryMonthlyOrdersCount())
                ->description("Total orders for the month.")
                ->descriptionIcon('heroicon-o-shopping-cart')
                ->color("success")
                ->chart($this->queryMonthlyOrdersData()),

            Stat::make('Monthly Revenue', '$'.$this->queryMonthlyRevenue())
                ->description("Total revenue for the month.")
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color("success")
                ->chart($this->queryMonthlyRevenueData()),

            Stat::make('Total Orders', $this->queryTodayOrdersCount())
                ->description("Total orders for today.")
                ->descriptionIcon('heroicon-o-shopping-cart')
                ->color("primary"),

            Stat::make('Total Revenue', '$'.$this->queryTodayRevenue())
                ->description("Total revenue earned today.")
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color("info"),
        ];
    }

    private function queryMonthlyOrdersCount(): int
    {
        return DB::table('orders')
            ->where("cashier_id", auth()->id())
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();
    }

    private function queryMonthlyRevenue(): string
    {
        $result = DB::table('orders')
            ->where("cashier_id", auth()->id())
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');

        $formattedRevenue = number_format($result, 2);

        return $formattedRevenue;
    }

    private function queryMonthlyOrdersData(): array
    {
        $monthlyOrdersData = DB::table('orders')
            ->selectRaw('COUNT(*) as total_orders, strftime("%d", created_at) as day')
            ->where("cashier_id", auth()->id())
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->groupBy(DB::raw('strftime("%d", created_at)'))
            ->pluck('total_orders', 'day')
            ->toArray();

        $chartData = [];

        for ($day = 1; $day <= now()->daysInMonth; $day++) {
            $chartData[] = $monthlyOrdersData[$day] ?? 0;
        }

        return $chartData;
    }

    private function queryMonthlyRevenueData(): array
    {
        $monthlyRevenueData = DB::table('orders')
            ->selectRaw('SUM(total_amount) as total_revenue, strftime("%d", created_at) as day')
            ->where("cashier_id", auth()->id())
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->groupBy(DB::raw('strftime("%d", created_at)'))
            ->pluck('total_revenue', 'day')
            ->toArray();

        $chartData = [];

        for ($day = 1; $day <= now()->daysInMonth; $day++) {
            $chartData[] = $monthlyRevenueData[$day] ?? 0;
        }

        return $chartData;
    }


    private function queryTodayOrdersCount(): int
    {
        return DB::table('orders')
            ->where("cashier_id", auth()->id())
            ->whereDate('created_at', now()->toDateString())
            ->count();
    }

    private function queryTodayRevenue(): string
    {
        $result = DB::table('orders')
            ->where("cashier_id", auth()->id())
            ->whereDate('created_at', now()->toDateString())
            ->sum('total_amount');

        $formattedRevenue = number_format($result, 2);

        return $formattedRevenue;
    }
}
