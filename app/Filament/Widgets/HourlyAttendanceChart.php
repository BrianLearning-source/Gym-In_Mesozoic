<?php

namespace App\Filament\Widgets;

use App\Models\Presensi;
use Filament\Widgets\ChartWidget;

class HourlyAttendanceChart extends ChartWidget
{
    protected ?string $heading = 'Member per Jam (Hari Ini)';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $today = today();
        $labels = [];
        $data = [];

        for ($i = 6; $i <= 23; $i++) {
            $labels[] = sprintf('%02d:00', $i);
            $data[] = Presensi::whereDate('created_at', $today)
                ->whereTime('start_time', '>=', sprintf('%02d:00:00', $i))
                ->whereTime('start_time', '<', sprintf('%02d:00:00', $i + 1))
                ->count();
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
