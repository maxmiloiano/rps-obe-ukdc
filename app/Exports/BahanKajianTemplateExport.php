<?php

namespace App\Exports;

use App\Models\BahanKajian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BahanKajianTemplateExport implements FromCollection, WithHeadings
{
    protected $kurikulum_id;

    public function __construct($kurikulum_id)
    {
        $this->kurikulum_id = $kurikulum_id;
    }

    public function collection()
    {
        return BahanKajian::where('kurikulum_id', $this->kurikulum_id)
            ->select('kode_bahan_kajian', 'nama_bahan_kajian', 'deskripsi')
            ->get();
    }

    public function headings(): array
    {
        return [
            'kode_bahan_kajian',
            'nama_bahan_kajian',
            'deskripsi'
        ];
    }
}
