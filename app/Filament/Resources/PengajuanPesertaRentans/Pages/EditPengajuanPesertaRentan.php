<?php

namespace App\Filament\Resources\PengajuanPesertaRentans\Pages;

use App\Filament\Resources\PengajuanPesertaRentans\PengajuanPesertaRentanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPengajuanPesertaRentan extends EditRecord
{
    protected static string $resource = PengajuanPesertaRentanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
