<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->selectable()
            ->columns([
                ImageColumn::make('images'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('category')
                    ->searchable(),
            ])
            ->filters(
                [
                    SelectFilter::make('is_published')
                        ->label('Published')
                        ->options([
                            true => 'Published',
                            false => 'Not published',
                        ]),
                    SelectFilter::make('is_active')
                        ->label('Active')
                        ->options([
                                null => 'All',
                                true => 'Active',
                                false => 'In Active',
                        ])->default(null),
                    SelectFilter::make('category')
                        ->label('Category')
                        ->relationship('category', 'name')
                ],
                layout: FiltersLayout::AboveContent
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
