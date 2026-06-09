<?php

namespace App\Filament\Resources\AnggotaModels;

use App\Filament\Resources\AnggotaModels\Pages\CreateAnggotaModel;
use App\Filament\Resources\AnggotaModels\Pages\EditAnggotaModel;
use App\Filament\Resources\AnggotaModels\Pages\ListAnggotaModels;
use App\Filament\Resources\AnggotaModels\Schemas\AnggotaModelForm;
use App\Filament\Resources\AnggotaModels\Tables\AnggotaModelsTable;
use App\Filament\Resources\AnggotaModels\Pages\SelectRegister;
use App\Models\AnggotaModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AnggotaModelResource extends Resource
{
    protected static ?string $model = AnggotaModel::class;

    protected static ?string $modelLabel = "Anggota";

    protected static string | UnitEnum | null $navigationGroup = 'Keanggotaan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AnggotaModelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnggotaModelsTable::configure($table);
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
            'index' => ListAnggotaModels::route('/'),
            // 'create' => CreateAnggotaModel::route('/create'),
            'edit' => EditAnggotaModel::route('/{record}/edit'),
            // 'select' => SelectRegister::route('/select'),
        ];
    }
}
