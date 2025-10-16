<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_number')
                    ->required(),
                TextInput::make('branch_id')
                    ->numeric(),
                TextInput::make('created_by')
                    ->numeric(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                TextInput::make('payment_type'),
                TextInput::make('payment_status')
                    ->required()
                    ->default('unpaid'),
                Textarea::make('images')
                    ->columnSpanFull(),
            ]);
    }
}
