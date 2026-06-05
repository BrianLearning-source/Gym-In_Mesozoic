<?php

namespace App\Filament\Resources\AnggotaModels\Pages;

use App\Filament\Resources\AnggotaModels\AnggotaModelResource;
use App\Models\AnggotaModel;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateAnggotaModel extends CreateRecord
{
    protected static string $resource = AnggotaModelResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!isset($data['password']) || blank($data['password'])) {
            $data['password'] = '1234';
        }
        $data['password'] = bcrypt($data['password']);

        if (!isset($data['qr_code']) || blank($data['qr_code'])) {
            $data['qr_code'] = $this->generateQRCode();
        }

        return $data;
    }

    private function generateQRCode(): string
    {
        do {
            $qrCode = 'GYM' . Str::upper(Str::random(8));
        } while (AnggotaModel::where('qr_code', $qrCode)->exists());

        return $qrCode;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
