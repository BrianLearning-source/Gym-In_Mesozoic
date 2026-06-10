<?php

namespace App\Filament\Resources\KepadatanGyms;

use App\Filament\Resources\KepadatanGyms\Pages\KepadatanGymCustom;
use App\Models\KepadatanGym;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class KepadatanGymResource extends Resource
{
    protected static ?string $model = KepadatanGym::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowTrendingUp;

    protected static string | UnitEnum | null $navigationGroup = 'Fitur';

    public static function getPages(): array
    {
        return [
            'index' => KepadatanGymCustom::route('/'),
        ];
    }
}
