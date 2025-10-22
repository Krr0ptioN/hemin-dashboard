<?php

namespace App\Filament\Resources\Orders\Schemas;

use Barryvdh\Debugbar\Facades\Debugbar;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\RepeatableEntry;

use App\Models\Product;
use App\Models\Branch;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->columnSpanFull()->schema([
                    Wizard::make([
                        Step::make('Select branch')->schema([
                            Select::make('customer_id')
                                ->relationship('customer','email'),
                            Select::make('branch_id')
                                ->relationship('branch','name'),
                        ]),
                        Step::make('Select products')->schema([
                            Repeater::make('orderProducts')
                                ->addActionLabel('Add product')
                                ->table([
                                    TableColumn::make('Product'),
                                    TableColumn::make('Amount'),
                                    TableColumn::make('Unit Price (Before Tax)'),
                                    TableColumn::make('Price (Before Tax)'),
                                ])
                                ->reactive()
                                ->schema([
                                    Select::make('product_id')
                                        ->label('Product')
                                        ->relationship('orderProducts.product', 'name')
                                        ->required(),

                                    TextInput::make('amount')
                                        ->label('Amount')
                                        ->numeric()
                                        ->default(1)
                                        ->required()
                                        ->reactive()
                                        ->live(debounce: 500)
                                        ->afterStateUpdated(function (callable $set, callable $get) {
                                            $unitPrice = (float) $get('unit_price_before_tax');
                                            $amount = (int) $get('amount');
                                            $set('price_before_tax', $amount * $unitPrice);
                                        }),

                                    TextInput::make('unit_price_before_tax')
                                        ->label('Unit Price (Before Tax)')
                                        ->numeric()
                                        ->suffix('₺')
                                        ->required()
                                        ->reactive()
                                        ->live(debounce: 500)
                                        ->afterStateUpdated(function (callable $set, callable $get) {
                                            $unitPrice = (float) $get('unit_price_before_tax');
                                            $amount = (int) $get('amount');
                                            $set('price_before_tax', $amount * $unitPrice);
                                        }),

                                    TextInput::make('price_before_tax')
                                        ->label('Price (Before Tax)')
                                        ->numeric()
                                        ->suffix('₺')
                                        ->disabled(),
                                ])
                        ]),
                        Step::make('Summary')->schema([
                            KeyValueEntry::make("Branch Detail")
                                ->state(function ($get) {
                                    $branch_id = (int)$get('branch_id');
                                    $branch = Branch::where('id', $branch_id)->first();
                                    return [
                                        'Name' => $branch?->name,
                                        'Address' => $branch?->address,
                                        'Code' => $branch?->code,
                                    ];
                            }),
                            Repeater::make('orderProducts')
                                ->table([
                                    TableColumn::make('Product'),
                                    TableColumn::make('Amount'),
                                    TableColumn::make('Unit Price (Before Tax)'),
                                    TableColumn::make('Price (Before Tax)'),
                                ])
                                ->disabled()
                                ->schema([
                                    Select::make('product_id')
                                        ->label('Product')
                                        ->options(\App\Models\Product::pluck('name', 'id'))
                                        ->disabled(),

                                    TextInput::make('amount')->label('Amount')->disabled(),
                                    TextInput::make('unit_price_before_tax')->label('Unit Price (₺)')->disabled(),
                                    TextInput::make('price_before_tax')->label('Total Price (₺)')->disabled(),
                                ]),
                        ]),
                    ]),
                ]),
            ]);
    }
}
