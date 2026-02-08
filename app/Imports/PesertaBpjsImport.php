<?php

namespace App\Imports;

use App\Models\PesertaBpjs;
use Maatwebsite\Excel\Concerns\{
    ToModel,
    WithHeadingRow
};
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PesertaBpjsImport implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 1;
    }

    public function model(array $row)
    {
        if (empty($row['nik'])) {
            return null;
        }
        
        return PesertaBpjs::updateOrCreate(
            ['nik' => $row['nik']],
            [
                'kpj' => $row['kpj'] ?? null,
                'nama' => $row['nama'] ?? null,
                'tgl_lahir' => $this->parseDate($row['tgl_lahir'] ?? null),
                'no_handphone' => $row['no_handphone'] ?? null,

                'jht' => (int) ($row['program'] ?? 0),
                'jkk' => (int) ($row[9] ?? 0),
                'jkm' => (int) ($row[10] ?? 0),

                'jenis_pekerjaan' => $row['jenis_pekerjaan'] ?? null,
                'tgl_kepesertaan' => $this->parseDate($row['tgl_kepesertaan'] ?? null),
                'tgl_berakhir' => $this->parseDate($row['tgl_berakhir'] ?? null),
                'masa_grace' => $this->parseDate($row['masa_grace'] ?? null),
            ]
        );
    }

    private function parseDate($value)
    {
        if (empty($value)) {
            return null;
        }

        // 1️⃣ Excel numeric date (contoh: 37936)
        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)
                ->format('Y-m-d');
        }

        // 2️⃣ Normalisasi bulan Indonesia → Inggris
        $bulan = [
            'JAN' => 'JAN',
            'FEB' => 'FEB',
            'MAR' => 'MAR',
            'APR' => 'APR',
            'MEI' => 'MAY',
            'JUN' => 'JUN',
            'JUL' => 'JUL',
            'AGS' => 'AUG',
            'AGT' => 'AUG',
            'AUG' => 'AUG',
            'SEP' => 'SEP',
            'OKT' => 'OCT',
            'NOV' => 'NOV',
            'DES' => 'DEC',
        ];

        $upper = strtoupper(trim($value));

        foreach ($bulan as $id => $en) {
            if (str_contains($upper, $id)) {
                $upper = str_replace($id, $en, $upper);
                break;
            }
        }

        // 3️⃣ Parse setelah dinormalisasi
        return Carbon::createFromFormat('d-M-y', $upper)
            ->format('Y-m-d');
    }
}