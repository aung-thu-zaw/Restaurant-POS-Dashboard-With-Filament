<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Tables;

class Product extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function hidden(): void
    {
        $this->status = 'hidden';

        $this->save();
    }

    public function published(): void
    {
        $this->status = 'published';

        $this->save();
    }

    public static function getForm(): array
    {
        return [
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Product Name')
                    ->unique(ignoreRecord: true)
                    ->required(),

                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category')
                    ->exists('categories', 'id')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('ingredients')
                    ->helperText('Maximum 255 Characters')
                    ->maxLength(255)
                    ->required(),

                Group::make()
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('qty')
                            ->label('Product Quantity')
                            ->numeric()
                            ->minValue(5)
                            ->required(),

                        Forms\Components\TextInput::make('stock_alert')
                            ->label('Product Stock Alert')
                            ->numeric()
                            ->minValue(1)
                            ->required(),

                        Forms\Components\TextInput::make('base_price')
                            ->label('Product Price')
                            ->numeric()
                            ->prefix('$')
                            ->required()
                        ]),

                Forms\Components\Toggle::make('is_discount')
                    ->default(false)
                    ->label('Add Discount')
                    ->live(),

                Group::make()
                    ->columnSpanFull()
                    ->columns(2)
                    ->hidden(fn (Get $get) => $get('is_discount') ? false : true)
                    ->schema([
                        Forms\Components\TextInput::make('discount_price')
                            ->label('Discount Price')
                            ->numeric()
                            ->prefix('$')
                            ->required(fn (Get $get) => $get('is_discount')),

                        Forms\Components\DatePicker::make('discount_end_date')
                            ->label('End Date')
                            ->format('d-m-Y')
                            ->native(false)
                            ->required(fn (Get $get) => $get('is_discount'))
                    ]),

                Forms\Components\RichEditor::make('description')->required(),

                Forms\Components\FileUpload::make('image')
                    ->label('Menu Image')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->preserveFilenames()
                    ->maxSize(1024 * 1024 * 2)
                    ->required(),

                Forms\Components\Toggle::make('is_available')
                    ->required()
            ]),
        ];
    }


    public static function getTableColumns(): array
    {
        return [
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
            ];
    }
}
