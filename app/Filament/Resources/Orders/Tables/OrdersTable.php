<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('order_number')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'approved' => 'info',
                        'preparing' => 'info',
                        'shipped' => 'warning',
                        'delivered' => 'success',
                        'returned' => 'gray',
                        'cancelled' => 'danger'
                    })
                    ->searchable(),
                TextColumn::make('total_amount')
                    ->money('TRY')
                    ->sortable(),
                TextColumn::make('payment_type')
                    ->searchable(),
                TextColumn::make('payment_status')
                    ->searchable(),
                TextColumn::make('customer.email')
                    ->label("Customer")
                    ->sortable(),
                TextColumn::make('branch.name')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                    SelectFilter::make('branch')
                        ->label('Branch')
                        ->relationship('branch', 'name'),
                    SelectFilter::make('status')
                        ->label('Status')
                    ->options([
                        null => 'All',
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'preparing' => 'Preparing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'returned' => 'Returned',
                        'cancelled' => 'Cancelled'
                    ]),
                    selectfilter::make('payment_status')
                        ->label('Payment Status')
                    ->options([
                        null => 'all',
                        'paid' => 'Paid',
                        'unpaid' => 'Unpaid'
                    ]),
            ],
                layout: FiltersLayout::AboveContent,

            )->filtersFormColumns(3)
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
