<?php

namespace App\Filament\Resources\Penukaran\Pages;

use App\Filament\Resources\Penukaran\PenukaranResource;
use App\Models\Penukaran;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use Livewire\Attributes\On;
use Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components\BarcodeInput;

class ScanPenukaran extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = PenukaranResource::class;
    protected string $view = 'filament.resources.penukaran.pages.scan';
    
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
                    ->label('Kode Penukaran')
                    ->placeholder('Masukkan kode penukaran manual')
                    ->required(),
            ])
            ->statePath('data');
    }
    
    public function prosesManual(): void
    {
        $data = $this->form->getState();
        $this->prosesScan($data['kode']);
    }
    
    #[On('scan-result')]
    public function prosesScan(string $kode): void
    {
        $kode = trim($kode);

        try {
            DB::transaction(function () use ($kode) {
                $penukarans = Penukaran::where('kode_penukaran', $kode)
                    ->where('status', 'pending')
                    ->get();

                if ($penukarans->isEmpty()) {
                    throw new \Exception('Kode penukaran tidak valid atau sudah diproses.');
                }

                $anggota = $penukarans->first()->anggota;

                foreach ($penukarans as $penukaran) {
                    if ($penukaran->reward->stock < 1) {
                        foreach ($penukarans as $p) {
                            $p->update(['status' => 'cancelled']);
                            $anggota->increment('points', $p->points_used);
                        }
                        throw new \Exception("Stok {$penukaran->reward->name} sudah habis. Semua penukaran dibatalkan.");
                    }
                }

                foreach ($penukarans as $penukaran) {
                    $penukaran->reward->decrement('stock');
                    $penukaran->update([
                        'status'     => 'claimed',
                        'claimed_at' => now(),
                    ]);
                }
            });

            Notification::make()
                ->title('Penukaran berhasil diproses!')
                ->success()
                ->send();

            $this->redirect(PenukaranResource::getUrl('index'));
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}