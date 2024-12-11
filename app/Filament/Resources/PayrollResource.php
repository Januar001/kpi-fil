<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Payroll;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Validation\ValidationException;
use App\Filament\Resources\PayrollResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PayrollResource\RelationManagers;

class PayrollResource extends Resource
{
    protected static ?string $model = Payroll::class;

    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make()
                ->schema([
                    Select::make('employee_id')
                        ->label('Employee')
                        ->required()
                        ->relationship('employee', 'name'),

                    Select::make('period_id')
                        ->label('Period')
                        ->required()
                        ->relationship('period', 'name'),

                    TextInput::make('base_salary')
                        ->label('Base Salary')
                        ->numeric()
                        ->prefix('Rp')
                        ->required(),
                        // ->step(0.01),

                    TextInput::make('total_salary')
                        ->label('Total Salary')
                        ->numeric()
                        ->prefix('Rp')
                        ->required()
                        ->gte('base_salary'),
                        // ->step(0.01),
                ])
                ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')->label('#')->rowIndex(),
                Tables\Columns\TextColumn::make('employee.name')->label('Employee')->searchable(),
                Tables\Columns\TextColumn::make('period.name')->label('Period')->searchable(),
                Tables\Columns\TextColumn::make('base_salary')->label('Base Salary')->money('idr', locale: 'id'),
                Tables\Columns\TextColumn::make('total_salary')->label('Total Salary')->money('idr', locale: 'id'),
                // Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
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
            'index' => Pages\ListPayrolls::route('/'),
            'create' => Pages\CreatePayroll::route('/create'),
            'edit' => Pages\EditPayroll::route('/{record}/edit'),
        ];
    }

    
}
