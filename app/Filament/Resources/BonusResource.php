<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Bonus;
use App\Models\Period;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BonusResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BonusResource\RelationManagers;

class BonusResource extends Resource
{
    protected static ?string $model = Bonus::class;

    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                Select::make('employee_id')
                    ->label('Employee')
                    ->options(Employee::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                
                Select::make('period_id')
                    ->label('Period')
                    ->options(Period::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                
                TextInput::make('bonus_amount')
                    ->label('Bonus Amount')
                    ->numeric()
                    ->required()
                    ->prefix('Rp')
                    ->minValue(0),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.name')
                    ->label('Employee')
                    ->searchable(),
                
                TextColumn::make('period.name')
                    ->label('Period')
                    ->searchable(),
                
                TextColumn::make('bonus_amount')
                    ->label('Bonus Amount')
                    ->money('idr', locale: 'id')
                    ->searchable(),
                
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBonuses::route('/'),
            'create' => Pages\CreateBonus::route('/create'),
            'edit' => Pages\EditBonus::route('/{record}/edit'),
        ];
    }
}
