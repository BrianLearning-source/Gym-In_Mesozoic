<?php

namespace App\Filament\Resources\GUsers\Pages;

use App\Filament\Resources\GUsers\GUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGUsers extends ListRecords
{
    protected static string $resource = GUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
