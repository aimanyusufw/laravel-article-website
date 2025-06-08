<?php

namespace App\Filament\Resources\ApiTokenResource\Pages;

use App\Filament\Resources\ApiTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateApiToken extends CreateRecord
{
    protected static string $resource = ApiTokenResource::class;
}
