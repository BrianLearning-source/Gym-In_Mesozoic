<?php

namespace App\Filament\Resources\Penggunas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')
            ->label('Nama')
            ->searchable()
            ->sortable(),
            TextColumn::make('email')
            ->label('Surel')
            ->searchable()
            ->sortable(),
            TextColumn::make('nomor_telepon')
            ->label('Nomor Telepon')
            ->searchable()
            ->sortable(),
        ])
        ->defaultSort('created_at', 'desc')
        ->filters([
            //
        ])
        ->recordActions([
            EditAction::make()->label('Ubah'),
            DeleteAction::make()->label('Hapus')
        ])
        ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make()->label('Hapus'),
            ]),
        ]);
    }
}
