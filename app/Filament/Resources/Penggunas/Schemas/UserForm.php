<?php

namespace App\Filament\Resources\Penggunas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use App\Rules\PhoneNumber;
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
                            ->label('Surel Admin')
                            ->email()
                            ->required()
                            ->placeholder('Surel Admin')
                            ->maxLength(255),
                        TextInput::make('nomor_telepon') -> label('Nomor telepon')
                            ->required()
                            ->tel()
                            ->placeholder('+62xxxxxxxxxxx')
                            ->minLength(10)
                            ->maxLength(15)
                            ->rule(new PhoneNumber),
                        TextInput::make('password') -> label('Kata sandi')
                            ->password()
                            ->placeholder('******')
                            ->required()
                    ])
                
                
            ]);
    }
}
