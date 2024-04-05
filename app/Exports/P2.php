<?php

namespace App\Exports;

use App\Models\IUP;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class P2 implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View{
        $p2 = IUP::where('tahapanKegiatan', 'Perpanjangan 2 IUP Tahap Operasi Produksi')->get();
        return view('admin.export.p2', ['p2' => $p2]);
    }
}
