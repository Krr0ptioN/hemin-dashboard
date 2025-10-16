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
        $number = random_int(1, 100);;
        $data['order_number'] = 'ORD-' . $number;
        $data['payment_status'] = 'unpaid';
        $data['payment_type'] = 'Cash';
        Debugbar::info($data);

        return $data;
    }

}
