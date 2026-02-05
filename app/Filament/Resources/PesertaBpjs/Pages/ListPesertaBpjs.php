<?php

namespace App\Filament\Resources\PesertaBpjs\Pages;

use App\Filament\Resources\PesertaBpjs\PesertaBpjsResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Excel;
use PesertaBpjsImport;

class ListPesertaBpjs extends ListRecords
{
    protected static string $resource = PesertaBpjsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('import')
            ->label('Import Excel')
            ->icon('heroicon-o-arrow-up-tray')
            ->form([
                FileUpload::make('file')
                    ->required()
                    ->acceptedFileTypes([
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/vnd.ms-excel'
                    ]),
            ])
            ->action(function (array $data, Excel $excel) {
                $excel->import(new \App\Imports\PesertaBpjsImport(), $data['file']);
            })
            ->successNotificationTitle('Import berhasil')
        ];
    }
}
