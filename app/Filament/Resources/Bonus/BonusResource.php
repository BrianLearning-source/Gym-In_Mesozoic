<?php

namespace App\Filament\Resources\Bonus;

use App\Filament\Resources\Bonus\Pages\CreateRewards;
use App\Filament\Resources\Bonus\Pages\EditRewards;
use App\Filament\Resources\Bonus\Pages\ListRewards;
use App\Filament\Resources\Bonus\Schemas\RewardsForm;
use App\Filament\Resources\Bonus\Tables\RewardsTable;
use App\Models\Rewards;
use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BonusResource extends Resource
{
    protected static ?string $model = Rewards::class;

    protected static ?string $modelLabel = "Bonus";

    protected static string | UnitEnum | null $navigationGroup = 'Fitur';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Gift;

    protected static ?string $navigationLabel = 'Bonus';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return RewardsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RewardsTable::configure($table);
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
            'index' => ListRewards::route('/'),
            // 'create' => CreateRewards::route('/create'),
            'edit' => EditRewards::route('/{record}/edit'),
        ];
    }
}
