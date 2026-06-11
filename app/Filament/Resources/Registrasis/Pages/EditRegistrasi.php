<?php

namespace App\Filament\Resources\Registrasis\Pages;

use App\Filament\Resources\Registrasis\RegistrasiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRegistrasi extends EditRecord
{
    protected static string $resource = RegistrasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
