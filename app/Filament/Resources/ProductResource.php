<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema(Product::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(Product::getTableColumns())
            ->defaultSort('id', 'desc')
            ->filtersTriggerAction(fn ($action) => $action->button()->label('Filters'))
            ->filters([
                TernaryFilter::make('is_available')->label('Is Available ?'),
                SelectFilter::make('status')
                    ->label('Product Status')
                    ->options([
                        'published' => 'Published',
                        'draft' => 'Draft',
                        'hidden' => 'Hidden',
                    ]),
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
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
                ])->icon('heroicon-o-cog-6-tooth'),
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
