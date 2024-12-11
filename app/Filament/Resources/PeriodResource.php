<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Period;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PeriodResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PeriodResource\RelationManagers;

class PeriodResource extends Resource
{
    protected static ?string $model = Period::class;

    protected static ?string $navigationIcon = 'heroicon-s-clock';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Period Name')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->required()
                            ->afterOrEqual('start_date'),
                        Toggle::make('is_active')
                            ->label('Is Active')
                            ->default(true),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')->label('#')->rowIndex(),
                TextColumn::make('name')->label('Period Name')->searchable()->sortable(),
                TextColumn::make('start_date')->label('Start Date')->date()->sortable(),
                TextColumn::make('end_date')->label('End Date')->date()->sortable(),
                ToggleColumn::make('is_active')->label('Active Status')->sortable(),
                // TextColumn::make('created_at')->label('Created At')->dateTime(),
                // TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->label('Active Periods')
                    ->query(fn (Builder $query) => $query->where('is_active', true)),
                Tables\Filters\Filter::make('inactive')
                    ->label('Inactive Periods')
                    ->query(fn (Builder $query) => $query->where('is_active', false)),
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
            'index' => Pages\ListPeriods::route('/'),
            'create' => Pages\CreatePeriod::route('/create'),
            'edit' => Pages\EditPeriod::route('/{record}/edit'),
        ];
    }
}
