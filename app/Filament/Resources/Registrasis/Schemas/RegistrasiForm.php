<?php

namespace App\Filament\Resources\Registrasis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

class RegistrasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('username')
                    ->label('Nama Pengguna')
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->required(),
                TextInput::make('phone_number')
                    ->label('Nomor Telepon')
                    ->required()
                    ->tel()
                    ->minLength(10)
                    ->maxLength(15),
                TextInput::make('password')
                    ->label('Kata Sandi')
                    ->required()
                    ->password(),
                TextInput::make('rest_days')
                    ->default(2),
                DateTimePicker::make('join_date')
                    ->label('Tanggal Bergabung')
                    ->required()
            ]);
    }
}
