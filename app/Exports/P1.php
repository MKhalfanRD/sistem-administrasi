<?php

namespace App\Exports;

use App\Models\IUP;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class P1 implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View{
        $p1 = IUP::where('tahapanKegiatan', 'Perpanjangan 1 IUP Tahap Operasi Produksi')->get();
        return view('admin.export.p1', ['p1' => $p1]);
    }
}
