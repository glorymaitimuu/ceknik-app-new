<?php

namespace App\Filament\Resources\PengajuanPesertaRentans\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\URL;
use Filament\Tables\Table;

class PengajuanPesertaRentansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('nik_hash', hash('sha256', $search));
                    }),

                TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nomor_telepon')
                    ->label('No. Telepon')
                    ->searchable(),

                TextColumn::make('kecamatan')
                    ->label('Kecamatan')
                    ->sortable(),

                TextColumn::make('kelurahan')
                    ->label('Kelurahan'),
                
                TextColumn::make('pekerjaan_1')
                    ->label('Pekerjaan Utama')
                    ->toggleable(),

                TextColumn::make('pekerjaan_2')
                    ->label('Pekerjaan Sampingan')
                    ->toggleable(),

                IconColumn::make('persetujuan_data')
                    ->label('Persetujuan')
                    ->boolean(),

                TextColumn::make('waktu_persetujuan')
                    ->label('Waktu Pengajuan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('view_ktp')
                    ->label('Lihat KTP')
                    ->icon('heroicon-o-identification')
                    ->color('success')
                    ->url(fn($record) => URL::temporarySignedRoute('pengajuan.file', now()->addMinutes(30), ['file' => basename($record->file_ktp)]))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('waktu_persetujuan', 'desc');
    }
}
