<?php

namespace App\Filament\Resources\GUsers\Pages;

use App\Filament\Resources\GUsers\GUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGUser extends CreateRecord
{
    protected static string $resource = GUserResource::class;
}
