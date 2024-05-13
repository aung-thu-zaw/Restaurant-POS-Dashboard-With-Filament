<?php

namespace App\Filament\Cashier\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            // ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\ImageColumn::make('product.image')->label("Image"),
                Tables\Columns\TextColumn::make('product.name')->label("Item"),
                Tables\Columns\TextColumn::make('unit_price')->money("USD"),
                Tables\Columns\TextColumn::make('qty'),
                Tables\Columns\TextColumn::make('total_price')->money("USD"),
            ]);
    }
}
