<?php

namespace App\Filament\Resources\Rewards\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class RewardsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Barang')
                    ->required(),

                FileUpload::make('image')
                    ->label('Gambar')
                    ->required()
                    ->disk('public')
                    ->directory('rewards'),

                TextInput::make('points_required')
                    ->numeric()
                    ->minValue(0)
                    ->label('Poin yang dibutuhkan')
                    ->required(),

                TextInput::make('stock')
                    ->numeric()
                    ->minvalue(0)
                    ->label('Stok')
                    ->required(),
                    ]);
    }
}
