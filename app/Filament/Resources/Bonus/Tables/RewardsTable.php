<?php

namespace App\Filament\Resources\Bonus\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class RewardsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reward_id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true), 
                TextColumn::make('name')
                    ->label('Nama barang')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('image')
                    ->disk('public')
                    ->label('Gambar'),
                TextColumn::make('points_required')
                    ->label('Poin yang dibutuhkan')
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('Stok')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->label('Ubah'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Hapus'),
                ]),
            ]);
    }
}
