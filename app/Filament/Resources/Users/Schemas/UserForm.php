<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name') -> label('Nama')
                ->required()
                ->maxLength(255),
                TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
                TextInput::make('nomor_telepon') -> label('Nomor telepon')
                ->required()
                ->maxLength(13),
                TextInput::make('password') -> label('Kata sandi')
                ->password()
                ->required()
                
            ]);
    }
}
