<?php

namespace App\Filament\Resources\KepadatanGyms\Pages;

use App\Filament\Resources\KepadatanGyms\KepadatanGymResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKepadatanGyms extends ListRecords
{
    protected static string $resource = KepadatanGymResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
