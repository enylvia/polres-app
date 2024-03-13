<?php

namespace App\Exports;

use App\Models\Laporan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class LaporanExport implements FromView, ShouldAutoSize, WithHeadings, WithStyles
{
    public function view(): View
    {
        return view('laporan.export', [
            'laporan' => Laporan::select('no_laporan', 'tanggal_laporan', 'tanggal_hilang', 'deskripsi')->get()
        ]);
    }

    public function headings(): array
    {
        return [
            'No Laporan',
            'Tanggal Laporan',
            'Tanggal Hilang',
            'Deskripsi',
        ];
    }

    public function styles($sheet)
    {
        return [
            'A1:D1'  => ['font-weight' => 'bold', 'border' => 'solid', 'border-color' => 'black']
        ];
    }
}
