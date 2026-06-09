<?php

namespace App\Filament\Resources\AnggotaModels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Tabs;
Use Filament\Support\Icons\Heroicon;
Use Filament\Schemas\Components\Wizard;
Use Filament\Schemas\Components\Wizard\Step;
Use Illuminate\Support\Facades\Blade;
Use Illuminate\Support\HtmlString;



class AnggotaModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                    Wizard::make([
                        Step::make('Identitas Pribadi')
                                ->inlineLabel()
                                ->completedIcon(Heroicon::OutlinedUser)
                                ->schema([
                                    TextInput::make('username')
                                        ->label('Nama Pengguna')
                                        ->placeholder('Masukkan nama pengguna')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->maxLength(50),
                                    TextInput::make('name')
                                        ->label('Nama Lengkap')
                                        ->placeholder('Masukkan nama lengkap')
                                        ->required()
                                        ->maxLength(100),
                                    TextInput::make('email')
                                        ->label('Email')
                                        ->placeholder('Masukkan email')
                                        ->required()
                                        ->email()
                                        ->unique(ignoreRecord: true)
                                        ->maxLength(100),
                                    Select::make('gender')
                                        ->label('Jenis Kelamin')
                                        ->placeholder('Pilih jenis kelamin')
                                        ->options([
                                            'Perempuan' => 'Perempuan',
                                            'Laki-laki' => 'Laki-laki',
                                        ]),
                                    TextInput::make('phone_number')
                                        ->label('Nomor Telepon')
                                        ->placeholder('+62xxxxxxxxxx')
                                        ->tel()
                                        ->maxLength(20),
                                        ])
                                        ->columns(2),
                        Step::make('Akun Pribadi')
                                ->inlineLabel()
                                ->columns(2)
                                ->completedIcon(Heroicon::UserCircle)
                                ->schema([
                                    TextInput::make('password')
                                        ->label('Kata Sandi')
                                        ->placeholder('******')
                                        ->password()
                                        ->hiddenOn('edit')
                                        ->dehydrated(fn ($state) => filled($state)),
                                    TextInput::make('title')
                                        ->placeholder('Masukkan gelar pengguna')
                                        ->label('Gelar'),
                                    DateTimePicker::make('join_date')
                                        ->label('Tanggal Bergabung')
                                        ->default(now()),
                                        ]),

                        Step::make('Atribut Lainnya')
                                ->inlineLabel()
                                ->columns(2)
                                ->completedIcon(Heroicon::PuzzlePiece)
                                ->schema([
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
                                        ]),                   
                        ])->submitAction(new HtmlString(Blade::render(<<<BLADE
                                    <x-filament::button
                                    type="submit"
                                    size="sm"
                                >
                                    Kirim
                                </x-filament::button>
                            BLADE)))     
                        ->columnSpanFull()
                        ->contained(true)
                        ->skippable()
                    ]);
    }
}
