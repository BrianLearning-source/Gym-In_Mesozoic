<?php

namespace App\Filament\Resources\Presensis;

use App\Filament\Resources\Presensis\Pages\CreatePresensi;
use App\Filament\Resources\Presensis\Pages\EditPresensi;
use App\Filament\Resources\Presensis\Pages\Absent;
use App\Filament\Resources\Presensis\Schemas\PresensiForm;
use App\Filament\Resources\Presensis\Tables\PresensisTable;
use App\Models\Presensi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PresensiResource extends Resource
{
    protected static ?string $model = Presensi::class;

    protected static string | UnitEnum | null $navigationGroup = 'Fitur';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PresensiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PresensisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Absent::route('/'),
            'create' => CreatePresensi::route('/create'),
            'edit' => EditPresensi::route('/{record}/edit'),
        ];
    }
}
