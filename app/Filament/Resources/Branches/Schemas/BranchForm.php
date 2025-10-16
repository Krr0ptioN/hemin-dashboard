<?php

namespace App\Filament\Resources\Branches\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BranchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Branches Detail")->schema([
                    TextInput::make('name')->label('Name')->required(),
                    TextInput::make('address')->label('Address')->required(),
                    TextInput::make('code')->label('Code')->required(),
                ])
            ]);
    }
}
