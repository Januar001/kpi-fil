<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KpiCriteria;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KpiCriteriaResource\Pages;
use App\Filament\Resources\KpiCriteriaResource\RelationManagers;

class KpiCriteriaResource extends Resource
{
    protected static ?string $model = KpiCriteria::class;

    protected static ?string $navigationIcon = 'heroicon-s-document-check';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                        Forms\Components\Select::make('position_id')
                                    ->label('Position')
                                    ->required()
                                    ->relationship('position', 'name')
                                    // ->searchable()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Position Name')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                        Forms\Components\TextInput::make('criteria_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('weight')
                            ->label('Weight (%)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(0.01),
            ])

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('#')->rowIndex(),
                Tables\Columns\TextColumn::make('position.name')->label('Position')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('criteria_name')->label('Criteria Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('weight')->label('Weight (%)')->sortable(),
                // Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                // Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
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
            'index' => Pages\ListKpiCriterias::route('/'),
            'create' => Pages\CreateKpiCriteria::route('/create'),
            'edit' => Pages\EditKpiCriteria::route('/{record}/edit'),
        ];
    }
}
