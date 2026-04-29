<?php

namespace App\Filament\Resources\GUsers\Pages;

use App\Filament\Resources\GUsers\GUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGUser extends EditRecord
{
    protected static string $resource = GUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
