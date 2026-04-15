<?php

namespace App\Filament\Resources\PengajuanPesertaRentans;

use App\Filament\Resources\PengajuanPesertaRentans\Pages\CreatePengajuanPesertaRentan;
use App\Filament\Resources\PengajuanPesertaRentans\Pages\EditPengajuanPesertaRentan;
use App\Filament\Resources\PengajuanPesertaRentans\Pages\ListPengajuanPesertaRentans;
use App\Filament\Resources\PengajuanPesertaRentans\Pages\ViewPengajuanPesertaRentan;
use App\Filament\Resources\PengajuanPesertaRentans\Schemas\PengajuanPesertaRentanForm;
use App\Filament\Resources\PengajuanPesertaRentans\Schemas\PengajuanPesertaRentanInfolist;
use App\Filament\Resources\PengajuanPesertaRentans\Tables\PengajuanPesertaRentansTable;
use App\Models\PengajuanPesertaRentan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PengajuanPesertaRentanResource extends Resource
{
    protected static ?string $model = PengajuanPesertaRentan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static ?string $navigationLabel = 'Pengajuan Peserta Rentan';

    protected static ?string $modelLabel = 'Pengajuan';

    protected static ?string $pluralModelLabel = 'Data Pengajuan Peserta Rentan';

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return PengajuanPesertaRentanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PengajuanPesertaRentanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengajuanPesertaRentansTable::configure($table);
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
            'index' => ListPengajuanPesertaRentans::route('/'),
            'create' => CreatePengajuanPesertaRentan::route('/create'),
            'view' => ViewPengajuanPesertaRentan::route('/{record}'),
            'edit' => EditPengajuanPesertaRentan::route('/{record}/edit'),
        ];
    }
}
