<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApiTokenResource\Pages;
use App\Filament\Resources\ApiTokenResource\RelationManagers;
use App\Models\ApiToken;
use Filament\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApiTokenResource extends Resource
{
    protected static ?string $model = ApiToken::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationIcon = 'heroicon-o-key';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('app_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('expires_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateIcon('heroicon-o-key')
            ->emptyStateDescription('Here are your api token place')
            ->columns([
                Tables\Columns\TextColumn::make('app_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('secret_token')
                    ->sortable()
                    ->copyable()
                    ->formatStateUsing(fn($state) => substr($state, 0, 35) . '......')
                    ->copyMessage('Token copied!')
                    ->copyMessageDuration(1500)
                    ->icon('heroicon-m-document-duplicate')
                    ->iconPosition(IconPosition::After),
                Tables\Columns\TextColumn::make('expires_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApiTokens::route('/'),
            // 'create' => Pages\CreateApiToken::route('/create'),
            // 'edit' => Pages\EditApiToken::route('/{record}/edit'),
        ];
    }
}
