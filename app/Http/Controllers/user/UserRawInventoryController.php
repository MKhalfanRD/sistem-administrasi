<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\rawInventori;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserRawInventoryController extends Controller
{
    public function index(){
        $rawInventori = rawInventori::all();

        return view('rawInventori.index', compact(['rawInventori']));
    }

    public function create(){
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $startBulan = Carbon::now()->startOfYear()->locale('id_ID');
        $bulan = [];

        for ($i = 0; $i < 12; $i++) {
            $bulan[] = $startBulan->formatLocalized('%B');
            $startBulan->addMonths(1);
        }

        $startTahun = 2010;
        $endTahun = Carbon::now()->year;
        $tahun = [];

        for ($i = $startTahun; $i <= $endTahun; $i++) {
            $tahun[$i] = $i;
        }
        return view('rawInventori.create', compact(['perusahaanUser', 'bulan', 'tahun']));
    }

    public function edit($id){
        $rawInventori = rawInventori::find($id);
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $startBulan = Carbon::now()->startOfYear()->locale('id_ID');
        $bulan = [];

        for ($i = 0; $i < 12; $i++) {
            $bulan[] = $startBulan->formatLocalized('%B');
            $startBulan->addMonths(1);
        }

        $startTahun = 2010;
        $endTahun = Carbon::now()->year;
        $tahun = [];

        for ($i = $startTahun; $i <= $endTahun; $i++) {
            $tahun[$i] = $i;
        }

        return view('rawInventori.edit', compact(['rawInventori' ,'perusahaanUser', 'bulan', 'tahun']));
    }

    public function store(Request $request){
        session()->flashInput($request->input());
        $request->validate([
            'namaPerusahaan' => 'required',
            'volumeRawInventori' => 'nullable',
            'tonaseRawInventori' => 'nullable',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $rawInventoriData = $request->all();
        $rawInventori = rawInventori::create($rawInventoriData);
        dd($rawInventori);
        return redirect()->route('rawInventori.index');
    }

    public function update(Request $request, $id){
        $request->validate([
            'namaPerusahaan' => 'required',
            'volumeRawInventori' => 'required',
            'tonaseRawInventori' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $rawInvetori = rawInventori::find($id);
        $rawInvetoriData = $request->all();
        $rawInvetori->update($rawInvetoriData);

        return redirect()->route('rawInventori.index');
    }

    public function destroy($id){
        $rawInvetori = rawInventori::find($id);

        $rawInvetori->delete();

        return redirect()->route('rawInventori.index');
    }
}
