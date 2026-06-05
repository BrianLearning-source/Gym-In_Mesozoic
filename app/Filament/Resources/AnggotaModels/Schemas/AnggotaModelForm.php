<?php

namespace App\Filament\Resources\AnggotaModels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;

class AnggotaModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('username')
                    ->label('Nama Pengguna')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(100),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->maxLength(100),
                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Perempuan' => 'Perempuan',
                        'Laki-laki' => 'Laki-laki',
                    ]),
                TextInput::make('phone_number')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->maxLength(20),
                TextInput::make('password')
                    ->label('Kata Sandi')
                    ->password()
                    ->hiddenOn('edit')
                    ->dehydrated(fn ($state) => filled($state)),
                TextInput::make('title')
                    ->label('Gelar'),
                DateTimePicker::make('join_date')
                    ->label('Tanggal Bergabung')
                    ->default(now()),
                TextInput::make('points')
                    ->label('Poin')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
                TextInput::make('streak')
                    ->label('Streak')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
                TextInput::make('highest_streak')
                    ->label('Streak Tertinggi')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
                TextInput::make('rest_days')
                    ->label('Hari Istirahat')
                    ->numeric()
                    ->default(2)
                    ->minValue(0),
            ]);
    }
}
