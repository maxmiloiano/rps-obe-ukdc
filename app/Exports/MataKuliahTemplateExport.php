<?php

namespace App\Exports;

use App\Models\MataKuliah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MataKuliahTemplateExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return MataKuliah::select('kode_mk', 'nama_mk', 'deskripsi')->get();
    }

    public function headings(): array
    {
        return [
            'kode_mk',
            'nama_mk',
            'deskripsi'
        ];
    }
}
