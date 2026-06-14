<?php

namespace App\Filament\Resources\Presensis\Pages;

use App\Filament\Resources\Presensis\PresensiResource;
use App\Filament\Resources\Presensis\Tables\PresensisTable;
use App\Models\PerkembanganModel;
use App\Models\Presensi;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Pages\Page;
use Filament\Notifications\Notification;
use App\Models\AnggotaModel;
use App\Services\StreakService;
use Filament\Schemas\Schema;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;

class Absent extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static string $resource = PresensiResource::class;

    protected static ?string $title = 'Presensi';

    protected string $view = 'filament.resources.presensis.pages.absent';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function table(Table $table): Table
    {
        return PresensisTable::configure($table)
            ->query(Presensi::query()->latest());
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Select::make('anggota_id')
                    ->label('Pilih Anggota')
                    ->placeholder('Pilih Anggota')
                    ->options(AnggotaModel::all()->mapWithKeys(fn($m) => [
                        $m->id => $m->username
                            ? "ID: {$m->id} - {$m->username} ({$m->name})"
                            : "ID: {$m->id} - {$m->name}"
                    ]))
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),
                TimePicker::make('start_time')
                    ->label('Jam Mulai')
                    ->required()
                    ->default(now()),
                TimePicker::make('end_time')
                    ->label('Jam Selesai')
                    ->required()
                    ->default(now()->addHour()),
            ])
            ->columns(2)
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        $bentrok = Presensi::where('anggota_id', $data['anggota_id'])
            ->whereDate('created_at', today())
            ->where(function ($q) use ($data) {
                $q->whereTime('start_time', '<', $data['end_time'])
                  ->whereTime('end_time', '>', $data['start_time']);
            })
            ->exists();

        if ($bentrok) {
            Notification::make()
                ->title('Duplikasi Absensi')
                ->body('Anggota ini sudah memiliki absensi pada rentang waktu yang sama hari ini.')
                ->danger()
                ->send();
            return;
        }

        Presensi::create([
            'anggota_id' => $data['anggota_id'],
            'name' => AnggotaModel::find($data['anggota_id'])?->name,
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
        ]);

        $member = AnggotaModel::find($data['anggota_id']);
        if ($member) {
            app(StreakService::class)->updateStreak($member);
        }

        PerkembanganModel::updateOrCreate(
            [
                'anggota_id' => $data['anggota_id'],
                'date'       => today()->format('Y-m-d'),
            ],
            [
                'start_time' => $data['start_time'],
                'end_time'   => $data['end_time'],
            ]
        );

        Notification::make()
            ->title('Absensi berhasil dicatat')
            ->success()
            ->send();
        $this->form->fill();
    }

}
