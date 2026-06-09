<?php

namespace App\Filament\Resources\Penggunas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Admin')
                    ->inlineLabel()
                    ->columnSpanFull()
                    ->components([
                        TextInput::make('name') -> label('Nama')
                            ->required()
                            ->placeholder('Nama Admin')
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->placeholder('Email Admin')
                            ->maxLength(255),
                        TextInput::make('nomor_telepon') -> label('Nomor telepon')
                            ->required()
                            ->placeholder('+62xxxxxxxxxxx')
                            ->maxLength(13),
                        TextInput::make('password') -> label('Kata sandi')
                            ->password()
                            ->placeholder('******')
                            ->required()
                    ])
                
                
            ]);
    }
}
