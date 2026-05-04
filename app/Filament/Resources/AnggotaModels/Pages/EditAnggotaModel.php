<?php

namespace App\Filament\Resources\AnggotaModels\Pages;

use App\Filament\Resources\AnggotaModels\AnggotaModelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAnggotaModel extends EditRecord
{
    protected static string $resource = AnggotaModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
