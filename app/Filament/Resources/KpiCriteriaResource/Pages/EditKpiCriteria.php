<?php

namespace App\Filament\Resources\KpiCriteriaResource\Pages;

use App\Filament\Resources\KpiCriteriaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKpiCriteria extends EditRecord
{
    protected static string $resource = KpiCriteriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
