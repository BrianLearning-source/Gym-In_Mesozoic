<?php

namespace App\Filament\Resources\Penukaran\Pages;

use App\Filament\Resources\Penukaran\PenukaranResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPenukaran extends ListRecords
{
    protected static string $resource = PenukaranResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('scan')
                ->label('Pindai QR')
                ->icon('heroicon-o-qr-code') // Memberikan icon opsional
                ->color('success') // Mengubah warna tombol opsional
                ->url(fn (): string => PenukaranResource::getUrl('scan')),

            CreateAction::make()->label('Tambah Penukaran'),
        ];
    }

    }

