<?php

namespace App\Filament\Resources\ApiTokenResource\Pages;

use App\Filament\Resources\ApiTokenResource;
use App\Models\ApiToken;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Str;


class ListApiTokens extends ListRecords
{
    protected static string $resource = ApiTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createAuto')
                ->label('Generate Token')
                ->icon('heroicon-m-plus')
                ->action(function () {
                    ApiToken::create([
                        'app_name' => "API-TOKEN-" . rand(11111111, 99999999),
                        'secret_token' => Str::random(60),
                        'admin_id' => auth()->id(),
                        'expires_at' => now()->addDay(30),
                    ]);
                    Notification::make()
                        ->title('Token created successfully!')
                        ->success()
                        ->send();
                }),
        ];
    }
}
