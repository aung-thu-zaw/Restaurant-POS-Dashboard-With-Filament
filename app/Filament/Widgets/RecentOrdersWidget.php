<?php

namespace App\Filament\Widgets;

use App\Filament\Cashier\Resources\OrderResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort("created_at", "desc")
            ->columns([
                Tables\Columns\TextColumn::make('order_no')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('customer_name')
                ->default('-')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('customer_phone')
                ->default('-')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('product_qty')
                ->label('Total Qty')
                ->numeric()
                ->sortable(),

            Tables\Columns\TextColumn::make('total_amount')
                ->money('USD')
                ->sortable(),

            Tables\Columns\TextColumn::make('order_type')
                ->formatStateUsing(fn ($state) => ucwords($state)),

            Tables\Columns\TextColumn::make('payment_method')
                ->formatStateUsing(fn ($state) => ucwords($state)),

            Tables\Columns\TextColumn::make('payment_status')
                ->sortable()
                ->badge()
                ->formatStateUsing(fn ($state) => ucwords($state))
                ->icon(static function (string $state): string {
                    if ($state === 'completed') {
                        return 'heroicon-o-check-circle';
                    } elseif ($state === 'pending') {
                        return 'heroicon-o-arrow-path';
                    }

                    return 'heroicon-arrow-path';
                })
                ->color(
                    fn (string $state): string => match ($state) {
                        'pending' => 'info',
                        'completed' => 'success',
                        default => 'primary',
                    },
                ),

            Tables\Columns\TextColumn::make('purchased_at')->default('-'),

            Tables\Columns\TextColumn::make('status')
                ->label('Order Status')
                ->sortable()
                ->badge()
                ->formatStateUsing(fn ($state) => ucwords($state))
                ->icon(static function (string $state): string {
                    if ($state === 'completed') {
                        return 'heroicon-o-check-circle';
                    } elseif ($state === 'pending') {
                        return 'heroicon-o-arrow-path';
                    } elseif ($state === 'cancelled') {
                        return 'heroicon-o-x-circle';
                    }

                    return 'heroicon-arrow-path';
                })
                ->color(
                    fn (string $state): string => match ($state) {
                        'pending' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'primary',
                    },
                ),
            ]);
    }
}
