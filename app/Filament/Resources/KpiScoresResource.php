<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Panel;
use Filament\Tables;
use App\Models\KpiScore;
use Filament\Forms\Form;
use App\Models\KpiScores;
use Filament\Tables\Table;
use Filament\Resources\Resource;
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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
