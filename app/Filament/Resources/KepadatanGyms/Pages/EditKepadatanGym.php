<?php

namespace App\Filament\Resources\KepadatanGyms\Pages;

use App\Filament\Resources\KepadatanGyms\KepadatanGymResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKepadatanGym extends EditRecord
{
    protected static string $resource = KepadatanGymResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
