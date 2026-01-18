<?php

namespace App\Imports;

use App\Models\BahanKajian;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BahanKajianImport implements ToCollection, WithHeadingRow
{
    protected $kurikulum_id;

    public function __construct($kurikulum_id)
    {
        $this->kurikulum_id = $kurikulum_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (empty($row['kode_bahan_kajian'])) continue;

            BahanKajian::updateOrCreate(
                [
                    'kode_bahan_kajian' => $row['kode_bahan_kajian'],
                    'kurikulum_id' => $this->kurikulum_id
                ],
                [
                    'nama_bahan_kajian' => $row['nama_bahan_kajian'],
                    'deskripsi' => $row['deskripsi']
                ]
            );
        }
    }
}
