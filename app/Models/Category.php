<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Filament\Forms;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class Category extends Model
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

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function getForm(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                        Forms\Components\TextInput::make('name')
                        ->label('Category Name')
                        ->unique(ignoreRecord: true)
                        ->required(),

                        Forms\Components\Toggle::make('status')->required(),
                ]),
        ];
    }
}
