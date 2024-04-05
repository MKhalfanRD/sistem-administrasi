<?php

namespace App\Exports;

use App\Models\IUP;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Wiup implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View{
        $wiup = IUP::where('tahapanKegiatan', 'WIUP')->get();
        return view('admin.export.wiup', ['wiup' => $wiup]);
    }
}

