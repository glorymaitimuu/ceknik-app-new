<?php

namespace App\Filament\Resources\PesertaBpjs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PesertaBpjsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kpj')
                    ->label('KPJ')
                    ->searchable(),

                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tgl_lahir')
                    ->label('Tgl Lahir')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('no_handphone')
                    ->label('No HP')
                    ->searchable(),

                IconColumn::make('jht')
                    ->label('JHT')
                    ->boolean(),

                IconColumn::make('jkk')
                    ->label('JKK')
                    ->boolean(),

                IconColumn::make('jkm')
                    ->label('JKM')
                    ->boolean(),

                TextColumn::make('jenis_pekerjaan')
                    ->label('Pekerjaan')
                    ->searchable(),

                TextColumn::make('tgl_kepesertaan')
                    ->label('Tgl Kepesertaan')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tgl_berakhir')
                    ->label('Tgl Berakhir')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('masa_grace')
                    ->label('Masa Grace')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('jenis_pekerjaan')
                    ->label('Jenis Pekerjaan')
                    ->options(
                        fn() =>
                        \App\Models\PesertaBpjs::query()
                            ->distinct()
                            ->pluck('jenis_pekerjaan', 'jenis_pekerjaan')
                            ->filter()
                            ->toArray()
                    ),

                SelectFilter::make('jht')
                    ->label('JHT')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak',
                    ]),

                SelectFilter::make('jkk')
                    ->label('JKK')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak',
                    ]),

                SelectFilter::make('jkm')
                    ->label('JKM')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('nama');
    }
}
