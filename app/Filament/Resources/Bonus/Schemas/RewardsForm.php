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
            ->components([
                Section::make('Reward ')
                    ->inlineLabel()
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
                    ->minvalue(0)
                    ->placeholder('Stok')
                    ->label('Stok')
                    ->required(),
                    ]), 
                    
                FileUpload::make('image')
                    ->label('Gambar')
                    ->required()
                    ->placeholder('Unggah gambar reward')
                    ->disk('public')
                    ->directory('rewards'),
                    ])->columns(2);
    }
}
