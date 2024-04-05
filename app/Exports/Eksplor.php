<?php

namespace App\Exports;

use App\Models\IUP;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Eksplor implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View{
        $eksplor = IUP::where('tahapanKegiatan', 'IUP Tahap Eksplorasi')->get();
        return view('admin.export.eksplorasi', ['eksplor' => $eksplor]);
    }
}
