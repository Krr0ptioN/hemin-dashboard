<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;
use Barryvdh\Debugbar\Facades\Debugbar;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $number = random_int(1, 100);
        $data['order_number'] = 'ORD-' . $number;

        $data['payment_status'] = 'unpaid';
        $data['payment_type'] = 'Cash';

        if (!empty($data['orderProducts'])) {
            $total = collect($data['orderProducts'])->sum(function ($item) {
                $unitPrice = (float) ($item['unit_price_before_tax'] ?? 0);
                $amount = (int) ($item['amount'] ?? 1);
                return $unitPrice * $amount;
            });

            $data['total_amount'] = $total;
        } else {
            $data['total_amount'] = 0;
        }

        Debugbar::info($data);

        return $data;
    }
}
