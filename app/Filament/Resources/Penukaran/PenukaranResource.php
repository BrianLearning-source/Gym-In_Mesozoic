<?php

namespace App\Filament\Resources\Penukaran;

use App\Filament\Resources\Penukaran\Pages\ListPenukaran;
use App\Filament\Resources\Penukaran\Pages\ScanPenukaran;
use App\Filament\Resources\Penukaran\Schemas\PenukaranForm;
use App\Filament\Resources\Penukaran\Tables\PenukaranTable;
use App\Models\Penukaran;
use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PenukaranResource extends Resource
{
    protected static ?string $model = Penukaran::class;

    protected static ?string $navigationLabel = 'Penukaran';
    protected static ?string $pluralLabel = 'Penukaran';

    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return 'heroicon-o-arrow-right-on-rectangle';
    }

    protected static ?string $recordTitleAttribute = 'kode_penukaran';

    public static function form(Schema $schema): Schema
    {
        return PenukaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenukaranTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPenukaran::route('/'),
            'scan'  => ScanPenukaran::route('/scan'),
        ];
    }
}
