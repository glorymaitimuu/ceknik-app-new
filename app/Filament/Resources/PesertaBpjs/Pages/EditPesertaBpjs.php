<?php

namespace App\Filament\Resources\PesertaBpjs\Pages;

use App\Filament\Resources\PesertaBpjs\PesertaBpjsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPesertaBpjs extends EditRecord
{
    protected static string $resource = PesertaBpjsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
