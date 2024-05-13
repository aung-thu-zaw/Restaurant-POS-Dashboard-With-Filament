<?php

namespace App\Filament\Cashier\Resources;

use App\Filament\Cashier\Resources\OrderResource\Pages;
use App\Filament\Cashier\Resources\OrderResource\RelationManagers\OrderItemsRelationManager;
use App\Models\Order;
use App\Models\Product;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\Fieldset as ComponentsFieldset;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                Step::make('Order Items')->schema([
                    TableRepeater::make('order_items')
                        ->label('Order Items')
                        ->markAsRequired()
                        ->headers([
                            Header::make('product_id')
                                ->label('Product')
                                ->width('300px')
                                ->align(Alignment::Center)
                                ->markAsRequired(),

                            Header::make('unit_price')
                                ->label('Unit Price')
                                ->align(Alignment::Center)
                                ->markAsRequired(),

                            Header::make('qty')
                                ->align(Alignment::Center)
                                ->markAsRequired(),

                            Header::make('total_price')
                                ->label('Total Price')
                                ->align(Alignment::Center)
                                ->markAsRequired(),
                        ])
                        ->schema([
                            Select::make('product_id')
                                ->label('Product')
                                ->options(Product::where('status', 'published')->where('is_available', true)->pluck('name', 'id'))
                                ->reactive()
                                ->afterStateUpdated(fn (?string $state, Set $set) => $set('unit_price', Product::find($state)?->base_price ?? 0))
                                ->afterStateUpdated(fn (Set $set) => $set('qty', 1))
                                ->afterStateUpdated(fn (Get $get, Set $set) => $set('total_price', $get('qty') * $get('unit_price')))
                                ->searchable()
                                ->preload()
                                ->required(),

                            TextInput::make('unit_price')
                                ->prefix('$')
                                ->numeric()
                                ->extraInputAttributes(['readonly' => true]),

                            TextInput::make('qty')
                                ->numeric()
                                ->minValue(1)
                                ->reactive()
                                ->afterStateUpdated(fn (?string $state, Get $get, Set $set) => $set('total_price', $state * $get('unit_price')))
                                ->required(),

                            TextInput::make('total_price')
                                ->prefix('$')
                                ->numeric()
                                ->extraInputAttributes(['readonly' => true]),
                        ]),
                ]),

                Step::make('Order Detail')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('order_no')
                            ->default(uniqid())
                            ->required(),

                        Forms\Components\Select::make('order_type')
                            ->options([
                                'takeaway' => 'Takeaway',
                                'dine-in' => 'Dine-in',
                            ])
                            ->required(),

                        Forms\Components\Select::make('payment_method')
                            ->options([
                                'card' => 'Card',
                                'cash' => 'Cash',
                            ])
                            ->required(),
                        Forms\Components\Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'completed' => 'Completed',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('note')
                            ->maxLength(255)
                            ->rows(5)
                            ->helperText('Maximum 255 Characters')
                            ->columnSpanFull(),

                        Fieldset::make('Customer Information (Optional)')->schema([
                            Forms\Components\TextInput::make('customer_name'),
                            Forms\Components\TextInput::make('customer_phone')->tel(),
                        ]),
                    ]),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        // $table->enum('status', ['pending','completed', 'cancelled'])->default('pending');

        return $table
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
            ])
            ->filters([
                //
            ])
            ->actions([

                ActionGroup::make([
                    Action::make('cancelled_order')
                        ->label('Cancel Order')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->visible(fn (Order $record) => $record->status === 'pending')
                        ->requiresConfirmation()
                        ->action(fn (Order $record) => $record->cancelled())
                        ->after(function () {
                            Notification::make()->success()->title('This order was cancelled.')->send();
                        }),

                    Action::make('completed_order')
                        ->label('Complete Order')
                        ->icon('heroicon-o-check-circle')
                        ->visible(fn (Order $record) => $record->status === 'pending')
                        ->color('success')
                        ->action(fn (Order $record) => $record->completed())
                        ->after(function () {
                            Notification::make()->success()->title('This order was completed.')->send();
                        }),

                    Action::make('completed_payment')
                        ->label('Complete Payment')
                        ->icon('heroicon-o-currency-dollar')
                        ->visible(fn (Order $record) => $record->payment_status === 'pending')
                        ->color('info')
                        ->action(fn (Order $record) => $record->paymentCompleted())
                        ->after(function () {
                            Notification::make()->success()->title('This order payment was completed.')->send();
                        }),
                ])->icon('heroicon-o-cog-6-tooth'),

                ActionGroup::make([

                    // Action::make("download")
                    //     ->icon('heroicon-o-arrow-down-tray')
                    //     ->color('primary')
                    //     ->action(function () {
                    //         return true;
                    //     }),

                    ViewAction::make()->color('info'),
                ]),

            ])
            ->bulkActions([]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Order Details')
                ->columns(3)
                ->schema([
                    ComponentsFieldset::make('General Information')
                        ->schema([
                            TextEntry::make('invoice_no')
                                ->label('Invoice Number'),

                            TextEntry::make('customer_name')
                                ->default('-')
                                ->label('Customer Name'),

                            TextEntry::make('order_type')
                                ->label('Order Type')
                                ->formatStateUsing(fn ($state) => ucwords($state)),

                            TextEntry::make('customer_phone')
                                ->default('-')
                                ->label('Customer Phone Number'),

                            TextEntry::make('note')
                                ->default('-')
                                ->label('Order Note')
                                ->columnSpanFull(),
                        ])
                        ->columnSpanFull()
                        ->columns(2),
                    ComponentsFieldset::make('Payment Information')
                        ->schema([
                            TextEntry::make('payment_method')
                                ->label('Payment Method')
                                ->formatStateUsing(fn ($state) => ucwords($state)),

                            TextEntry::make('payment_status')
                                ->label('Payment Status')
                                ->formatStateUsing(fn ($state) => ucwords($state))
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

                            TextEntry::make('purchased_at')
                                ->label('Purchased At')
                                ->dateTime(),
                        ])
                        ->columnSpanFull()
                        ->columns(3),

                    ComponentsFieldset::make('Order Items')->schema([
                        TextEntry::make('product_qty')
                            ->label('Total Item Quantity'),

                        TextEntry::make('total_amount')
                            ->label('Total Item Amount')
                            ->money('USD'),
                    ])
                        ->columnSpanFull()
                        ->columns(2),
                ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            OrderItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
