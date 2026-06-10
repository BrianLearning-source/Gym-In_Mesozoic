<?php

namespace App\Filament\Resources\Registrasis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;

class RegistrasisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Surel')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->label('Nomor Telepon')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('join_date')
                    ->label('Tanggal Bergabung')
                    ->sortable()
                    ->date(),
            ])->defaultSort('join_date')
            ->filters([
                 Filter::make('join_date', 'desc')
                    ->label('Tanggal bergabung')
                        ->schema([
                            DatePicker::make('join_date')
                                ->label('Pilih Tanggal: ')
                                ->native(false)
                                ->displayFormat('d/m/Y'),
                        ])
                        ->query(function ( $query, $data){
                            return $query   
                                ->when(
                                    $data['join_date'],
                                    fn ($query, $date) => $query->whereDate('join_date', $date)
                                );
                        })
            ])
            ->recordActions([
                EditAction::make()->label('Ubah'),
                DeleteAction::make()->label('Hapus'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Hapus'),
                ]),
            ]);
    }
}
