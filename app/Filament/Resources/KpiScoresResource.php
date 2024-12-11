<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Panel;
use Filament\Tables;
use App\Models\Period;
use App\Models\Employee;
use App\Models\KpiScore;
use Filament\Forms\Form;
use App\Models\KpiScores;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Navigation\NavigationGroup;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KpiScoresResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KpiScoresResource\RelationManagers;

class KpiScoresResource extends Resource
{
    protected static ?string $model = KpiScore::class;

    protected static ?string $navigationIcon = 'heroicon-s-document-check';

    protected static ?string $navigationGroup = 'Report';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Select::make('employee_id')
                    ->label('Employee')
                    ->options(Employee::all()->pluck('name', 'id'))
                    ->required(),
                
                Select::make('period_id')
                    ->label('Period')
                    ->options(Period::all()->pluck('name', 'id'))
                    ->required(),
                
                TextInput::make('score')
                    ->label('Score')
                    ->type('number')
                    ->step(1)
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('#')->rowIndex(),

                TextColumn::make('employee.name')
                    ->label('Employee')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('period.name')
                    ->label('Period')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('score')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable()
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
            'index' => Pages\ListKpiScores::route('/'),
            'create' => Pages\CreateKpiScores::route('/create'),
            'edit' => Pages\EditKpiScores::route('/{record}/edit'),
        ];
    }
}
