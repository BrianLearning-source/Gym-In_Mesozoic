<?php

namespace App\Filament\Resources\KepadatanGyms\Pages;

use App\Filament\Resources\KepadatanGyms\KepadatanGymResource;
use Filament\Resources\Pages\Page;

class KepadatanGymCustom extends Page
{
    protected static string $resource = KepadatanGymResource::class;

    protected static ?string $title = 'Statistik & Detail Kepadatan Gym';

    protected string $view = 'filament.resources.kepadatan-gyms.pages.kepadatan-gym';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\GymStatsOverview::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            \App\Filament\Widgets\HourlyAttendanceChart::class,
            \App\Filament\Widgets\RecentAttendanceTable::class,
            \App\Filament\Widgets\WeeklyAttendanceChart::class,
            
        ];
    }
}
