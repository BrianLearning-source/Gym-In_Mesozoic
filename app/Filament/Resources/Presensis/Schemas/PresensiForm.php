<?php

namespace App\Filament\Resources\Presensis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;

class PresensiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('anggota_id')
                    ->label('Anggota')
                    ->relationship('anggota', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TimePicker::make('start_time')
                    ->label('Jam Mulai')
                    ->required()
                    ->default(now()),
                TimePicker::make('end_time')
                    ->label('Jam Selesai'),
            ]);
    }
}
