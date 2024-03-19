<?php

namespace App\Exports;

use App\Models\IUP;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IupExport implements FromView, ShouldAutoSize
{
    public function view(): View{
        $iup = IUP::all();
        return view('export.all', ['iup' => $iup]);
    }


    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // use Exportable;
    // public function query()
    // {
    //     return IUP::query();
    // }

    // public function map($iup): array{
    //     return[
    //         $iup->namaPerusahaan,
    //         $iup->alamat,
    //         $iup->npwp,
    //         $iup->nib,
    //         $iup->kabupaten,
    //         $iup->luasWilayah,
    //         $iup->komoditas,
    //         $iup->lokasiIzin,
    //         $iup->statusIzin,
    //     ];
    // }

    // public function headings(): array{
    //     return [
    //         'Nama Perusahaan',
    //         'Alamat',
    //         'NPWP',
    //         'NIB',
    //         'Kabupaten',
    //         'Luas Wilayah',
    //         'Komoditas',
    //         'Lokasi Izin',
    //         'Status Izin',
    //     ];
    // }
}
