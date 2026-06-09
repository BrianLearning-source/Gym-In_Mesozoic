<?php

namespace App\Filament\Resources\AnggotaModels\Pages;

use App\Filament\Resources\AnggotaModels\AnggotaModelResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\Registrasi;
use App\Models\AnggotaModel;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;

class ListAnggotaModels extends ListRecords
{
    protected static string $resource = AnggotaModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
        Action::make('SelectRegister')
                    ->label('Pilih Pengunjung yang terdaftar')
                    ->color('primary')
                    ->modalHeading('Pilih Pengunjung')
                    ->modalSubmitActionLabel('Aktivasi')
                    ->form([
                         Select::make('registrasi_id')
                            ->label('Pilih Pengunjung yang terdaftar')
                            ->placeholder('Pilih Pengunjung')
                            ->options(
                        Registrasi::whereNotIn('email', AnggotaModel::pluck('email')->toArray())
                            ->get()
                            ->mapWithKeys(fn($m) => [
                            $m->id => $m->username
                                ? "ID: {$m->id} - {$m->username} ({$m->name})"
                                : "ID: {$m->id} - {$m->name}"
                        ])
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ])
                        
                    ->action(function (array $data) {
                    $registration = Registrasi::find($data['registrasi_id']);

                    if (!$registration) {
                        return;
                    }


                    AnggotaModel::create([
        'username' => $registration->username,
        'name' => $registration->name,
        'title' => 'Pemula',
        'gender'=> 'Laki-laki',
        'email' => $registration->email,
        'password' => $registration->password,
        'phone_number' => $registration->phone_number,
        'join_date' => $registration->join_date,
        'points' => 0,
        'streak' => 0,
        'highest_streak' => 0,
        'qr_code' => null,
        'rest_days' => $registration->rest_days,
        'status'=> 'active',
        'avatar' => null,
        ]);

        Notification::make()
                        ->title('Berhasil')
                        ->body('Pengunjung berhasil diaktivasi menjadi anggota.')
                        ->success()
                        ->send();
                

                    return redirect()->to(AnggotaModelResource::getUrl('index'));
                }),

            CreateAction::make()->label('Tambah Anggota'),
        ];
    }
}
