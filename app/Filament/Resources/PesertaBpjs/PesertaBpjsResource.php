<?php

namespace App\Filament\Resources\PesertaBpjs;

use App\Filament\Resources\PesertaBpjs\Forms\PesertaBpjsForm;
use App\Filament\Resources\PesertaBpjs\Pages\CreatePesertaBpjs;
use App\Filament\Resources\PesertaBpjs\Pages\EditPesertaBpjs;
use App\Filament\Resources\PesertaBpjs\Pages\ListPesertaBpjs;
use App\Filament\Resources\PesertaBpjs\Tables\PesertaBpjsTable;
use App\Models\PesertaBpjs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PesertaBpjsResource extends Resource
{
    protected static ?string $model = PesertaBpjs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Peserta BPJS';

    public static function form(Schema $schema): Schema
    {
        return PesertaBpjsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PesertaBpjsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPesertaBpjs::route('/'),
            'create' => CreatePesertaBpjs::route('/create'),
            'edit' => EditPesertaBpjs::route('/{record}/edit'),
        ];
    }
}
