<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make()
                ->schema([
                    Section::make('Details')
                        ->schema([
                            TextInput::make('name')->label('Name')->required(),
                            RichEditor::make('description')->label('Description')->columnSpanFull(),
                            Select::make('category_id')->label('Category')
                                ->relationship('category', 'name')->searchable()->preload()->required(),
                            TextInput::make('youtube_video_id')->label('YouTube Video ID')
                                ->placeholder('Enter 11-character YouTube video ID')->maxLength(11),
                            FileUpload::make('images')->label('Images')->image()->multiple()->directory('products/images')->columnSpanFull(),
                            FileUpload::make('attachments')->label('Attachments')->multiple()->directory('products/attachments')->columnSpanFull(),
                            DateTimePicker::make('published_at')->label('Publish Date'),
                        ])
                        ->columnSpan([
                            'default' => 'full',
                            'sm' => 1,
                            'md' => 2,
                            'lg' => 10,
                        ])
                        ->extraAttributes(['class' => 'w-full'])
                        ->maxWidth(false),

                    Section::make('Publishing')
                        ->schema([
                            DateTimePicker::make('unpublished_at')->label('Unpublish Date'),
                            Toggle::make('is_featured')->label('Featured'),
                            Toggle::make('is_new')->label('New Product'),
                            Toggle::make('is_active')->label('Active / Inactive')->default(true),
                        ])
                        ->columnSpan([
                            'default' => 1,
                            'md' => 1,
                            'lg' => 8,
                        ])
                        ->extraAttributes(['class' => 'w-full'])
                        ->maxWidth(false),
                ])
                ->columns([
                    'default' => 1,
                    'md' => 3,
                ])
                ->maxWidth(false),
        ]);
    }
}
