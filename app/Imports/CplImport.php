<?php

namespace App\Imports;

use App\Models\Cpl;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CplImport implements ToCollection, WithHeadingRow
{
    protected $kurikulum_id;

    public function __construct($kurikulum_id)
    {
        $this->kurikulum_id = $kurikulum_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (
                empty($row['kode_cpl']) ||
                empty($row['deskripsi_cpl'])
            ) {
                continue;
            }

            Cpl::updateOrCreate(
                ['kode_cpl' => trim($row['kode_cpl'])],
                [
                    'deskripsi'    => trim($row['deskripsi_cpl']),
                    'kurikulum_id' => $this->kurikulum_id,
                ]
            );
        }
    }
}
