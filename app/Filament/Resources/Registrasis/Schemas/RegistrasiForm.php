<?php

namespace App\Filament\Resources\Registrasis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use App\Rules\PhoneNumber as PhoneNumberRule;

class RegistrasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->inlineLabel()
                    ->schema([
                            TextInput::make('username')
                                ->label('Nama Pengguna')
                                ->placeholder('Pengguna')
                                ->required(),
                            TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->placeholder('Nama Lengkap')
                                ->required(),
                            TextInput::make('email')
                                ->label('Surel')
                                ->placeholder('Surel')
                                ->required(),
                            TextInput::make('phone_number')
                                ->label('Nomor Telepon')
                                ->placeholder('+62xxxxxxxxxx')
                                ->required()
                                ->tel()
                                ->minLength(10)
                                ->maxLength(15)
                                ->rule(new PhoneNumberRule),
                            TextInput::make('password')
                                ->label('Kata Sandi')
                                ->placeholder('******')
                                ->required()
                                ->password(),
                            TextInput::make('rest_days')
                                ->label('Hari Istirahat')
                                ->placeholder('Jumlah hari istirahat')
                                ->default(2)
                                ->numeric(),
                            DateTimePicker::make('join_date')
                                ->label('Tanggal Bergabung')
                                ->placeholder('Pilih tanggal bergabung')
                                ->required()
                    ])
                    ->columns(2)
                    ->columnSpanFull()
            ]);

    }
}
