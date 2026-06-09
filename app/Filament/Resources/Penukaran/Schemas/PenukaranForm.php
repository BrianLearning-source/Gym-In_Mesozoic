<?php

namespace App\Filament\Resources\Penukaran\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;

class PenukaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('anggota_id')
                    ->label('Anggota')
                    ->relationship('anggota', 'name')
                    ->placeholder('Pilih Anggota')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('reward_id')
                    ->label('Hadiah')
                    ->placeholder('Pilih Hadiah')
                    ->relationship('reward', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('points_used')
                    ->label('Poin Digunakan')
                    ->numeric()
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->placeholder('Pilih Status')
                    ->options([
                        'pending' => 'Menunggu',
                        'claimed' => 'Diklaim',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->required(),
                DateTimePicker::make('claimed_at')
                    ->label('Tanggal & Jam Aktivasi')
                    ->seconds(false)
                    ->displayFormat('d M Y, H:i'),
            ]);
    }
}
