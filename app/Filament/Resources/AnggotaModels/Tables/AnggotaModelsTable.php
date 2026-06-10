<?php

namespace App\Filament\Resources\AnggotaModels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;

class AnggotaModelsTable
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
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('gender')
                    ->label('Jenis Kelamin')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('phone_number')
                    ->label('Nomor Telepon')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('streak')
                    ->label('Rentetan')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('join_date')
                    ->label('Tanggal Bergabung')
                    ->date('d/m/Y')
                    ->toggleable()
                    ->sortable()
            ])->defaultSort('join_date', 'desc')
            ->filters([
                Filter::make('created_at')
                    ->label('Tanggal bergabung')
                        ->schema([
                            DatePicker::make('created_at')
                                ->label('Pilih Tanggal: ')
                                ->native(false)
                                ->displayFormat('d/m/Y'),
                        ])
                        ->query(function ( $query, $data){
                            return $query   
                                ->when(
                                    $data['created_at'],
                                    fn ($query, $date) => $query->whereDate('created_at', $date)
                                );
                        }),
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
