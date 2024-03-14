<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\IUP;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IUPExport;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new IUPExport, 'data.xlsx'); // Replace YourExport with the name of your export class
    }
}
