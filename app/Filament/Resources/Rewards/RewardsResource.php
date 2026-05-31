<?php

namespace App\Filament\Resources\Rewards;

use App\Filament\Resources\Rewards\Pages\CreateRewards;
use App\Filament\Resources\Rewards\Pages\EditRewards;
use App\Filament\Resources\Rewards\Pages\ListRewards;
use App\Filament\Resources\Rewards\Schemas\RewardsForm;
use App\Filament\Resources\Rewards\Tables\RewardsTable;
use App\Models\Rewards;
use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RewardsResource extends Resource
{
    protected static ?string $model = Rewards::class;

    protected static string | UnitEnum | null $navigationGroup = 'Fitur';

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getNavigationIcon() : string | BackedEnum | Htmlable | null
    {
        return 'heroicon-o-gift';
    }

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
            'create' => CreateRewards::route('/create'),
            'edit' => EditRewards::route('/{record}/edit'),
        ];
    }
}
