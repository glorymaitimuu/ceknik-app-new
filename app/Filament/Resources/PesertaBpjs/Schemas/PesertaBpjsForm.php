<?php

namespace App\Filament\Resources\PesertaBpjs\Forms;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PesertaBpjsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Peserta')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('nik')
                                ->label('NIK')
                                ->required()
                                ->length(16)
                                ->numeric()
                                ->unique(ignoreRecord: true),

                            TextInput::make('kpj')
                                ->label('KPJ')
                                ->maxLength(20),

                            TextInput::make('nama')
                                ->label('Nama Lengkap')
                                ->required()
                                ->maxLength(100),

                            TextInput::make('no_handphone')
                                ->label('No. Handphone')
                                ->tel()
                                ->maxLength(20),

                            DatePicker::make('tgl_lahir')
                                ->label('Tanggal Lahir')
                                ->native(false)
                                ->displayFormat('d M Y'),
                        ]),
                    ]),

                Section::make('Program BPJS')
                    ->schema([
                        Grid::make(3)->schema([
                            Toggle::make('jht')
                                ->label('JHT')
                                ->default(false),

                            Toggle::make('jkk')
                                ->label('JKK')
                                ->default(false),

                            Toggle::make('jkm')
                                ->label('JKM')
                                ->default(false),
                        ]),
                    ]),

                Section::make('Informasi Pekerjaan & Kepesertaan')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('jenis_pekerjaan')
                                ->label('Jenis Pekerjaan')
                                ->maxLength(100),

                            DatePicker::make('tgl_kepesertaan')
                                ->label('Tanggal Kepesertaan')
                                ->native(false)
                                ->displayFormat('d M Y'),

                            DatePicker::make('tgl_berakhir')
                                ->label('Tanggal Berakhir')
                                ->native(false)
                                ->displayFormat('d M Y'),

                            DatePicker::make('masa_grace')
                                ->label('Masa Grace')
                                ->native(false)
                                ->displayFormat('d M Y'),
                        ]),
                    ]),
            ]);
    }
}
