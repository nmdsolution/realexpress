<?php

namespace App\Filament\Resources\ExpeditionResource\Widgets;

use App\Models\Expedition;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ExpeditionmoneyChart extends ChartWidget
{
    protected static ?string $heading = 'Suivie des Colis envoyez';

    protected function getData(): array
    {
        $data = Trend::model(Expedition::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
        )
            ->perMonth()
            ->count('prix');

        return [
            'datasets' => [
                [

                    'label' => 'Colis Envoyez',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

}
