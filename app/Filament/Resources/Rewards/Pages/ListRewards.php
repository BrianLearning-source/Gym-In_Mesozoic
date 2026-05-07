<?php

namespace App\Filament\Resources\Rewards\Pages;

use App\Filament\Resources\Rewards\RewardsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRewards extends ListRecords
{
    protected static string $resource = RewardsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
