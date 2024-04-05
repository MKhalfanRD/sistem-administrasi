<?php

namespace App\Exports;

use App\Models\IUP;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OP implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View{
        $op = IUP::where('tahapanKegiatan', 'IUP Tahap Operasi Produksi')->get();
        return view('admin.export.op', ['op' => $op]);
    }
}
