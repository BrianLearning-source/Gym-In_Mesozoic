<?php

namespace App\Filament\Resources\Registrasis\Pages;

use App\Filament\Resources\Registrasis\RegistrasiResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRegistrasis extends ListRecords
{
    protected static string $resource = RegistrasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('scan')
                ->label('Scan QR')
                ->icon('heroicon-o-qr-code')
                ->color('success')
                ->url(fn (): string => RegistrasiResource::getUrl('scan')),

            CreateAction::make(),
        ];
    }
    }
