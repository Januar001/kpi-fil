<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('email')
                ->required()
                ->email(),
                Forms\Components\TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('#')->rowIndex(),
            TextColumn::make('name')
            ->searchable(),
            TextColumn::make('email')
            ->searchable(),
            // TextColumn::make('email_verified_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            // 'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
