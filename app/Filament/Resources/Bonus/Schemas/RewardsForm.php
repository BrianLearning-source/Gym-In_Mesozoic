<?php

namespace App\Filament\Resources\Bonus\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;

class RewardsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Detail Bonus')
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Barang')
                            ->placeholder('Nama Barang')
                            ->required(),
                        TextInput::make('points_required')
                            ->numeric()
                            ->placeholder('Jumlah Poin')
                            ->minValue(0)
                            ->label('Poin yang dibutuhkan')
                            ->required(),
                        TextInput::make('stock')
                            ->numeric()
                            ->minValue(0)
                            ->placeholder('Stok')
                            ->label('Stok')
                            ->required(),
                    ]),
                Section::make('Gambar')
                    ->columnSpan(1)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Gambar Hadiah')
                            ->required()
                            ->disk('public')
                            ->directory('rewards'),
                    ]),
            ])->columns(2);
    }
}
