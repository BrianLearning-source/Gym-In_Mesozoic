<?php

namespace App\Filament\Resources\Penukaran\Tables;

use App\Models\Penukaran;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class PenukaranTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('anggota.name')
                    ->label('Nama Anggota')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('reward.name')
                    ->label('Hadiah')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('points_used')
                    ->label('Poin')
                    ->sortable(),
                TextColumn::make('kode_penukaran')
                    ->label('Kode')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'claimed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'claimed' => 'Diklaim',
                        'cancelled' => 'Dibatalkan',
                        default => $state,
                    }),
                TextColumn::make('claimed_at')
                    ->label('Tgl Aktivasi')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Menunggu',
                        'claimed' => 'Diklaim',
                        'cancelled' => 'Dibatalkan',
                    ]),
            ])
            ->recordActions([
                Action::make('edit')
                    ->label('Ubah')
                    ->icon('heroicon-o-pencil')
                    ->form([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Menunggu',
                                'claimed' => 'Diklaim',
                                'cancelled' => 'Dibatalkan',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data, Penukaran $record) {
                        $new = $data['status'];
                        $orig = $record->status;
                        if ($orig === $new) return;

                        $anggota = $record->anggota;
                        $reward  = $record->reward;
                        $points  = $record->points_used;

                        if ($new === 'claimed') {
                            if ($reward->stock < 1) {
                                Notification::make()
                                    ->title("Stok {$reward->name} habis")
                                    ->danger()
                                    ->send();
                                return;
                            }
                            if ($orig === 'cancelled') {
                                if ($anggota->points < $points) {
                                    Notification::make()
                                        ->title('Poin anggota tidak mencukupi')
                                        ->danger()
                                        ->send();
                                    return;
                                }
                                $anggota->decrement('points', $points);
                            }
                            $reward->decrement('stock');
                            $data['claimed_at'] = now();
                        }

                        if ($new === 'cancelled' && $orig !== 'cancelled') {
                            $anggota->increment('points', $points);
                            if ($orig === 'claimed') {
                                $reward->increment('stock');
                            }
                            $data['claimed_at'] = null;
                        }

                        if ($new === 'pending' && $orig === 'claimed') {
                            $reward->increment('stock');
                            $data['claimed_at'] = null;
                        }

                        if ($new === 'pending' && $orig === 'cancelled') {
                            if ($anggota->points < $points) {
                                Notification::make()
                                    ->title('Poin anggota tidak mencukupi')
                                    ->danger()
                                    ->send();
                                return;
                            }
                            $anggota->decrement('points', $points);
                        }

                        $record->update($data);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Hapus'),
                ]),
            ]);
    }
}
