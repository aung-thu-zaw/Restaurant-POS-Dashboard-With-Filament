<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Total Orders';

    protected static ?int $sort = 2;

    protected static ?string $maxHeight = '350px';

    protected function getData(): array
    {
        $filter = $this->filter;

        match($filter) {
            "week" => $data = Trend::model(Order::class)
            ->between(start: now()->subWeek(), end: now())
            ->perMonth()
            ->count(),

            "month" => $data = Trend::model(Order::class)
            ->between(start: now()->subMonth(), end: now())
            ->perMonth()
            ->count(),

            "3 months" => $data = Trend::model(Order::class)
            ->between(start: now()->subMonths(3), end: now())
            ->perMonth()
            ->count(),

            null => $data = Trend::model(Order::class)
            ->between(start: now()->startOfYear(), end: now()->endOfYear())
            ->perMonth()
            ->count()
        };

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'week' => 'Last Week',
            'month' => 'Last Month',
            '3 months' => 'Last 3 Months',
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
