<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('order_number'),
                TextEntry::make('status'),
                TextEntry::make('total_amount')
                    ->numeric(),
                TextEntry::make('payment_type')
                    ->placeholder('-'),
                TextEntry::make('payment_status'),
                TextEntry::make('customer_id')
                    ->numeric(),
                TextEntry::make('branch_id')
                    ->numeric(),
            ]);
    }
}
