<?php

namespace App\Filament\Resources\ApiTokenResource\Pages;

use App\Filament\Resources\ApiTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApiToken extends EditRecord
{
    protected static string $resource = ApiTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
