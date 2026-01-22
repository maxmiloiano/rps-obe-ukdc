<?php

namespace App\Imports;

use App\Models\ProfilLulusan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProfilLulusanImport implements ToCollection, WithHeadingRow
{
    protected $kurikulum_id;

    public function __construct($kurikulum_id)
    {
        $this->kurikulum_id = $kurikulum_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // ⛔ Skip baris kosong
            if (
                empty($row['kode_pl']) ||
                empty($row['deskripsi_pl'])
            ) {
                continue;
            }

            ProfilLulusan::updateOrCreate(
                ['kode_pl' => trim($row['kode_pl'])],
                [
                    'deskripsi'    => trim($row['deskripsi_pl']), // ✅ FIX UTAMA
                    'kurikulum_id' => $this->kurikulum_id,
                ]
            );
        }
    }
}
