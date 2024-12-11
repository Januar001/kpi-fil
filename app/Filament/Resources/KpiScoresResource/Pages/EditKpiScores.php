<?php

namespace App\Filament\Resources\KpiScoresResource\Pages;

use App\Filament\Resources\KpiScoresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKpiScores extends EditRecord
{
    protected static string $resource = KpiScoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
