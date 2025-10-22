<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Barryvdh\Debugbar\Facades\Debugbar;

class TotalSalesChart extends ChartWidget
{
    protected ?string $heading = 'Total Sales Chart';

    protected function getData(): array
    {
        $orders = Order::selectRaw("
                strftime('%m', created_at) as month,
                SUM(total_amount) as total
            ")
            ->whereRaw("strftime('%Y', created_at) = ?", [date('Y')])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        Debugbar::info($orders);

        $monthLabels = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec',
        ];

        $labels = [];
        $data = [];

        foreach (range(1, 12) as $month) {
            $labels[] = $monthLabels[$month];
            $data[] = (float) ($orders->firstWhere('month', $month)->total ?? 0);
        }

        Debugbar::info($data);

        return [
            'datasets' => [
                [
                    'label' => 'Total Sales (₺)',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
