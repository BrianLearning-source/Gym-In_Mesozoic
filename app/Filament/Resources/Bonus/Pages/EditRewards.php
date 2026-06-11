<?php

namespace App\Filament\Resources\Bonus\Pages;

use App\Filament\Resources\Bonus\BonusResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRewards extends EditRecord
{
    protected static string $resource = BonusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
