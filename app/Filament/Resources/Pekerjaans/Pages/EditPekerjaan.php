<?php

namespace App\Filament\Resources\Pekerjaans\Pages;

use App\Filament\Resources\Pekerjaans\PekerjaanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPekerjaan extends EditRecord
{
    protected static string $resource = PekerjaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
