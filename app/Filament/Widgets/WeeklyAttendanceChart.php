<?php

namespace App\Filament\Widgets;

use App\Models\Presensi;
use Filament\Widgets\ChartWidget;

class WeeklyAttendanceChart extends ChartWidget
{
    protected static ?int $sort = 4;
    protected ?string $heading = 'Tren 7 Hari Terakhir';
    protected int|string|array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->locale('id')->translatedFormat('D');
            $data[] = Presensi::whereDate('created_at', $date->format('Y-m-d'))->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Member',
                    'data' => $data,
                    'backgroundColor' => '#34d399',
                    'borderColor' => '#059669',
                    'borderWidth' => 1,
                    'borderRadius' => 4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'color' => 'rgba(255,255,255,0.06)',
                    ],
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }
}
