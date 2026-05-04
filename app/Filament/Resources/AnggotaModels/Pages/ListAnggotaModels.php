<?php

namespace App\Filament\Resources\AnggotaModels\Pages;

use App\Filament\Resources\AnggotaModels\AnggotaModelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAnggotaModels extends ListRecords
{
    protected static string $resource = AnggotaModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
