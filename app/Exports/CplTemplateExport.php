<?php

namespace App\Exports;

use App\Models\Cpl;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class CplTemplateExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithColumnWidths
{
    protected $kurikulum_id;

    public function __construct($kurikulum_id)
    {
        $this->kurikulum_id = $kurikulum_id;
    }

    public function collection()
    {
        return Cpl::where('kurikulum_id', $this->kurikulum_id)->get();
    }

    public function headings(): array
    {
        return [
            'kode_cpl',
            'deskripsi_cpl'
        ];
    }

    public function map($row): array
    {
        return [
            $row->kode_cpl,
            $row->deskripsi
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 80,
        ];
    }
}
