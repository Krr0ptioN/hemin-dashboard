<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class TotalSalesChart extends ChartWidget
{
    protected ?string $heading = 'Total Sales Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
