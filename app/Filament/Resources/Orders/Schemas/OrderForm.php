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
                                        ->required(),

                                    TextInput::make('unit_price_before_tax')
                                        ->label('Unit Price (Before Tax)')
                                        ->numeric()
                                        ->suffix('₺')
                                        ->required()
                                        ->reactive(),

                                    TextInput::make('price_before_tax')
                                        ->label('Price (Before Tax)')
                                        ->numeric()
                                        ->suffix('₺')
                                        ->dehydrated(false)
                                        ->reactive()
                                        ->afterStateHydrated(function ($component, $state, $get) {
                                            $component->state(
                                                (int) $get('amount') * (float) $get('price_before_tax')
                                            );
                                        })->disabled(),
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
                            RepeatableEntry::make('orderProducts')
                                ->table([
                                    TableColumn::make('Product'),
                                    TableColumn::make('Amount'),
                                    TableColumn::make('Unit Price (Before Tax)'),
                                    TableColumn::make('Price (Before Tax)'),
                                ])
                                ->schema([
                                    TextEntry::make('product_id')
                                        ->label('Product')
                                        ->state(fn ($state) => \App\Models\Product::find($state)?->name),
                                    TextEntry::make('amount')->label('Amount'),
                                    TextEntry::make('unit_price_before_tax')->label('Unit Price (₺)'),
                                    TextEntry::make('price_before_tax')->label('Total Price (₺)'),
                                ]),
                        ]),
                    ]),
                ]),
            ]);
    }
}
