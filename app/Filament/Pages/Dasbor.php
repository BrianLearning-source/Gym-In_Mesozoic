<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard;

class Dasbor extends Dashboard
{
    protected static ?string $title = 'Beranda';

    public static function getNavigationLabel(): string
    {
        return 'Beranda';
    }

}