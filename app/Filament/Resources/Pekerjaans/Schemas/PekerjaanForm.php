<?php

namespace App\Filament\Resources\Pekerjaans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PekerjaanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
            ]);
    }
}
