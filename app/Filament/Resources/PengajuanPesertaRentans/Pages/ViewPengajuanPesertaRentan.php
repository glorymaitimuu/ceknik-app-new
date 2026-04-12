<?php

namespace App\Filament\Resources\PengajuanPesertaRentans\Pages;

use App\Filament\Resources\PengajuanPesertaRentans\PengajuanPesertaRentanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPengajuanPesertaRentan extends ViewRecord
{
    protected static string $resource = PengajuanPesertaRentanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
