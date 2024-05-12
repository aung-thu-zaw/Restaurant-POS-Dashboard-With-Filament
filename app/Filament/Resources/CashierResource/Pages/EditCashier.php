<?php

namespace App\Filament\Resources\CashierResource\Pages;

use App\Filament\Resources\CashierResource;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCashier extends EditRecord
{
    protected static string $resource = CashierResource::class;

    // protected function handleRecordUpdate(Model $record, array $data): Model
    // {
    //     $record->update[...$data,"role" => "cashier"]);

    //     return $record;
    // }
}
