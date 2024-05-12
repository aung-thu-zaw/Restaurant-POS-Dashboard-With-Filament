<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form->schema(Product::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->square(),
                Tables\Columns\TextColumn::make('name')
                    ->description(fn (Product $record): string => $record->ingredients ? Str::limit($record->ingredients, 60) : '')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_available')
                    ->label("Available")
                    ->boolean(),
                Tables\Columns\TextColumn::make('base_price')
                    ->label("Unit Price")
                    ->money("USD")
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_price')
                    ->label("Discount")
                    ->default('-')
                    ->money("USD")
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_end_date')
                    ->label("End Date")
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucwords($state))
                    ->icon(static function (string $state): string {
                        if ($state === 'published') {
                            return 'heroicon-o-check-circle';
                        } elseif($state === "hidden") {
                            return 'heroicon-o-x-circle';
                        } elseif($state === "draft") {
                            return 'heroicon-o-pencil';
                        }

                        return 'heroicon-o-pencil';
                    })
                    ->color(
                        fn (string $state): string => match ($state) {
                            "hidden" => 'danger',
                            'published' => 'success',
                            'draft' => 'warning',
                            default => 'primary'
                        },
                    ),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort("id", "desc")
            ->filtersTriggerAction(fn ($action) => $action->button()->label('Filters'))
            ->filters([
                TernaryFilter::make("is_available")->label("Is Available ?"),
                SelectFilter::make('status')
                ->label('Product Status')
                ->options([
                    'published' => 'Published',
                    'draft' => 'Draft',
                    'hidden' => 'Hidden',
                ]),
                SelectFilter::make('category_id')
                ->label('Category')
                ->relationship("category", "name")
                ->searchable()
                ->multiple()
                ->preload(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()->slideOver(),
                    Tables\Actions\DeleteAction::make(),
                ]),

                ActionGroup::make([
                    Action::make('hidden')
                        ->icon('heroicon-o-check-circle')
                        ->color('danger')
                        ->visible(fn (Product $record) => $record->status === 'published')
                        ->requiresConfirmation()
                        ->action(fn (Product $record) => $record->hidden())
                        ->after(function () {
                            Notification::make()->success()->title('This product was hidden.')->send();
                        }),

                    Action::make('published')
                        ->label('Publish')
                        ->icon('heroicon-o-check-circle')
                        ->visible(fn (Product $record) => $record->status === 'hidden' || $record->status === 'draft')
                        ->color('success')
                        ->action(fn (Product $record) => $record->published())
                        ->after(function () {
                            Notification::make()->success()->title('This product was published.')->send();
                        }),
                ])->icon("heroicon-o-cog-6-tooth"),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
        ];
    }
}
