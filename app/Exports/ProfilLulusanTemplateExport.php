<?php

namespace App\Exports;

use App\Models\ProfilLulusan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ProfilLulusanTemplateExport implements 
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

    /**
     * Ambil data PL sesuai kurikulum aktif
     */
    public function collection()
    {
        return ProfilLulusan::where('kurikulum_id', $this->kurikulum_id)->get();
    }

    /**
     * Header Excel
     */
    public function headings(): array
    {
        return [
            'kode_pl',
            'deskripsi_pl'
        ];
    }

    /**
     * Mapping kolom
     */
    public function map($row): array
    {
        return [
            $row->kode_pl,
            $row->deskripsi
        ];
    }

    /**
     * Lebar kolom
     */
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 80,
        ];
    }
}
