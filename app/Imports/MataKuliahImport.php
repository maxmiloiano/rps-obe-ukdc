<?php

namespace App\Imports;

use App\Models\MataKuliah;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MataKuliahImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (empty($row['kode_mk'])) continue;

            MataKuliah::updateOrCreate(
                ['kode_mk' => $row['kode_mk']],
                [
                    'nama_mk' => $row['nama_mk'],
                    'deskripsi' => $row['deskripsi']
                ]
            );
        }
    }
}
