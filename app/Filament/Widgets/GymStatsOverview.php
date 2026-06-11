<?php

namespace App\Filament\Widgets;

use App\Models\Presensi;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GymStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected ?string $heading = 'Statistik Gym';
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $kapasitas = 5;
        $nowTime = now()->format('H:i:s');
        $memberToday = Presensi::whereDate('created_at', today())
            ->whereTime('start_time', '<=', $nowTime)
            ->whereTime('end_time', '>', $nowTime)
            ->count();
        $sisa = max($kapasitas - $memberToday, 0);

        return [
            Stat::make('Kapasitas Gym', $kapasitas)
                ->description('orang')
                ->color('gray'),

            Stat::make('Sedang Latihan', $memberToday)
                ->description('member hari ini')
                ->color('success'),

            Stat::make('Sisa Kapasitas', $sisa)
                ->description('tersedia')
                ->color($sisa < 5 ? 'danger' : 'gray'),
        ];
    }
}
