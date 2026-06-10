<?php

namespace App\Filament\Resources\Registrasis\Pages;

use App\Filament\Resources\Registrasis\RegistrasiResource;
use App\Filament\Resources\AnggotaModels\AnggotaModelResource;
use App\Models\Registrasi;
use App\Models\AnggotaModel;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Page;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class ScanRegistrasi extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = RegistrasiResource::class;

    protected string $view = 'filament.resources.registrasis.pages.scan';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('kode')
                    ->label('Kode QR')
                    ->placeholder('Masukkan kode QR registrasi manual')
                    ->required(),
            ])
            ->statePath('data');
    }

    #[On('scan-result')]
    public function prosesScan(string $kode): void
    {
        $kode = trim($kode);

        try {
            DB::transaction(function () use ($kode) {
                $registrasi = Registrasi::where('qr_code', $kode)->first();

                if (!$registrasi) {
                    throw new \Exception('QR Code tidak valid atau sudah diproses.');
                }

                $exists = AnggotaModel::where('qr_code', $kode)->exists();
                if ($exists) {
                    throw new \Exception('QR Code ini sudah terdaftar sebagai anggota.');
                }

                AnggotaModel::create([
                    'username'       => $registrasi->username,
                    'name'           => $registrasi->name,
                    'email'          => $registrasi->email,
                    'phone_number'   => $registrasi->phone_number,
                    'password'       => $registrasi->password,
                    'rest_days'      => $registrasi->rest_days,
                    'qr_code'        => $registrasi->qr_code,
                    'join_date'      => $registrasi->join_date,
                    'title'          => 'Member',
                    'status'         => 'active',
                    'points'         => 0,
                    'streak'         => 0,
                    'highest_streak' => 0,
                ]);

                $registrasi->delete();
            });

            Notification::make()
                ->title('Anggota berhasil diaktivasi!')
                ->body('Data registrasi telah dipindahkan ke tabel anggota.')
                ->success()
                ->send();

            $this->redirect(AnggotaModelResource::getUrl('index'));
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function prosesManual(): void
    {
        $data = $this->form->getState();
        $this->prosesScan($data['kode']);
    }
}
