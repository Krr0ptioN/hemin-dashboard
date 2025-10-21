<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;

class LatestOrders extends TableWidget
{
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Order::query())
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
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
