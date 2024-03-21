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
            'laporan' => Laporan::select('laporans.no_laporan','laporans.alamat_pelapor','users.phone_number', 'laporans.tanggal_laporan', 'laporans.tanggal_hilang',
                'kendaraans.no_rangka','kendaraans.no_mesin','kendaraans.warna','users.name','laporans.deskripsi')
                ->join('kendaraans','laporans.id_kendaraan','=','kendaraans.id')
                ->join('users','laporans.id_user','=','users.id')
                ->get()
        ]);
    }

    public function headings(): array
    {
        return [
            'No Laporan',
            'Tanggal Laporan',
            'Tanggal Hilang',
            'No Rangka',
            'No Mesin',
            'Warna',
            'Pelapor',
            'Alamat Pelapor',
            'Nomor HP',
            'Deskripsi',
        ];
    }

    public function styles($sheet)
    {
        return [
            'A1:H1'  => ['font-weight' => 'bold', 'border' => 'solid', 'border-color' => 'black']
        ];
    }
}
