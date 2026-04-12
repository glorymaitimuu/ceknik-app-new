<?php

namespace App\Filament\Resources\PengajuanPesertaRentans\Pages;

use App\Filament\Resources\PengajuanPesertaRentans\PengajuanPesertaRentanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPengajuanPesertaRentans extends ListRecords
{
    protected static string $resource = PengajuanPesertaRentanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
