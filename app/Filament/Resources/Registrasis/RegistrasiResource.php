<?php

namespace App\Filament\Resources\Registrasis;

use App\Filament\Resources\Registrasis\Pages\CreateRegistrasi;
use App\Filament\Resources\Registrasis\Pages\EditRegistrasi;
use App\Filament\Resources\Registrasis\Pages\ListRegistrasis;
use App\Filament\Resources\Registrasis\Pages\ScanRegistrasi;
use App\Filament\Resources\Registrasis\Schemas\RegistrasiForm;
use App\Filament\Resources\Registrasis\Tables\RegistrasisTable;
use App\Models\Registrasi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RegistrasiResource extends Resource
{
    protected static ?string $model = Registrasi::class;

    protected static string | UnitEnum | null $navigationGroup = 'Keanggotaan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return RegistrasiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegistrasisTable::configure($table);
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
            'index' => ListRegistrasis::route('/'),
            // 'create' => CreateRegistrasi::route('/create'),
            'edit' => EditRegistrasi::route('/{record}/edit'),
            'scan'  => ScanRegistrasi::route('/scan'),
        ];
    }
}
