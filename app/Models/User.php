<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Forms;
use Filament\Tables;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    public static function getForm(): array
    {
        return [
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\FileUpload::make('avatar')
                        ->image()
                        ->avatar()
                        ->disk('public')
                        ->directory('cashiers')
                        ->preserveFilenames()
                        ->maxSize(1024 * 1024 * 2)
                        ->required()
                        ->alignCenter(),

                    Forms\Components\TextInput::make('name')
                        ->required(),

                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->unique(ignoreRecord: true)
                        ->required(),

                    Forms\Components\TextInput::make('phone')
                        ->tel()
                        ->unique(ignoreRecord: true)
                        ->required(),

                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->required()
                        ->hidden(fn ($operation): bool => $operation === "edit")
                ]),
        ];
    }

    public static function getTableColumns(): array
    {
        return [
            Tables\Columns\ImageColumn::make('avatar')
                ->circular(),

            Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('email')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('phone')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->formatStateUsing(fn ($state) => ucwords($state))
                ->icon(static function (string $state): string {
                    if ($state === 'active') {
                        return 'heroicon-o-check-circle';
                    } elseif ($state === 'suspended') {
                        return 'heroicon-o-x-circle';
                    }
                    return 'heroicon-o-x-circle';
                })
                ->color(
                    fn (string $state): string => match ($state) {
                        'suspended' => 'danger',
                        'active' => 'success',
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
                ->toggleable(isToggledHiddenByDefault: true)
        ];
    }
}
