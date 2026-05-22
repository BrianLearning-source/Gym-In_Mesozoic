<?php

namespace App\Filament\Widgets;

use App\Models\Presensi;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentAttendanceTable extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(Presensi::latest()->limit(10))
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('start_time')
                    ->label('Jam Mulai')
                    ->time('H:i'),
                TextColumn::make('end_time')
                    ->label('Jam Selesai')
                    ->time('H:i'),
                TextColumn::make('created_at')
                    ->label('Waktu Absen')
                    ->since(),
            ])
            ->paginated(false);
    }
}
