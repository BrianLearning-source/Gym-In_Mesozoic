<?php

namespace App\Filament\Resources\Registrasis\Pages;

use App\Filament\Resources\Registrasis\RegistrasiResource;
use App\Models\Registrasi;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateRegistrasi extends CreateRecord
{
    protected static string $resource = RegistrasiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        do {
            $data['qr_code'] = 'REG' . Str::upper(Str::random(6));
        } while (Registrasi::where('qr_code', $data['qr_code'])->exists());

        return $data;
    }
}
