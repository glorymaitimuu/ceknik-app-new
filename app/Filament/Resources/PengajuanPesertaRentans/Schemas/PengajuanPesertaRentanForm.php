<?php

namespace App\Filament\Resources\PengajuanPesertaRentans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PengajuanPesertaRentanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Peserta')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('nik')
                                ->label('NIK')
                                ->required()
                                ->length(16)
                                ->helperText('NIK tersimpan dalam format terenkripsi di database.'),

                            TextInput::make('nama')
                                ->label('Nama Lengkap')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('nomor_telepon')
                                ->label('Nomor Telepon')
                                ->tel()
                                ->required(),

                            TextInput::make('tempat_lahir')
                                ->label('Tempat Lahir')
                                ->required(),

                            DatePicker::make('tanggal_lahir')
                                ->label('Tanggal Lahir')
                                ->required()
                                ->native(false)
                                ->displayFormat('d M Y'),

                            \Filament\Forms\Components\Select::make('pekerjaan_1')
                                ->label('Pekerjaan Utama')
                                ->options(\App\Models\Pekerjaan::all()->pluck('nama', 'nama'))
                                ->required()
                                ->searchable(),

                            \Filament\Forms\Components\Select::make('pekerjaan_2')
                                ->label('Pekerjaan Sampingan')
                                ->options(\App\Models\Pekerjaan::all()->pluck('nama', 'nama'))
                                ->searchable(),
                        ]),
                    ]),

                Section::make('Wilayah & Alamat')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('provinsi')
                                ->label('Provinsi')
                                ->required(),

                            TextInput::make('kabupaten')
                                ->label('Kabupaten/Kota')
                                ->required(),

                            TextInput::make('kecamatan')
                                ->label('Kecamatan')
                                ->required(),

                            TextInput::make('kelurahan')
                                ->label('Kelurahan/Desa')
                                ->required(),

                            TextInput::make('rt')
                                ->label('RT')
                                ->length(3)
                                ->required(),

                            TextInput::make('rw')
                                ->label('RW')
                                ->length(3)
                                ->required(),

                            Textarea::make('alamat')
                                ->label('Alamat Lengkap')
                                ->columnSpanFull()
                                ->required(),
                        ]),
                    ]),

                Section::make('Persetujuan & Dokumentasi')
                    ->schema([
                        Grid::make(3)->schema([
                            Toggle::make('persetujuan_data')
                                ->label('Persetujuan Data')
                                ->disabled()
                                ->default(false),

                            DateTimePicker::make('waktu_persetujuan')
                                ->label('Waktu Persetujuan')
                                ->disabled()
                                ->native(false)
                                ->displayFormat('d M Y H:i'),

                            TextInput::make('file_ktp')
                                ->label('Path File KTP')
                                ->disabled()
                                ->helperText('Gunakan tombol aksis pada tabel untuk melihat foto.'),
                        ]),
                    ]),
            ]);
    }
}
