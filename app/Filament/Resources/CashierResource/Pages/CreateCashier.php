<?php

namespace App\Filament\Resources\CashierResource\Pages;

use App\Filament\Resources\CashierResource;
use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCashier extends CreateRecord
{
    protected static string $resource = CashierResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['role'] = "cashier";

    //     return $data;
    // }
}
