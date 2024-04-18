<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\StokProduk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminStokProdukController extends Controller
{
    public function index(){
        $stokProduk = StokProduk::all();

        return view('admin.stokProduk.index', compact(['stokProduk']));
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
        return view('admin.stokProduk.create', compact(['perusahaanUser', 'bulan', 'tahun']));
    }

    public function store(Request $request){
        session()->flashInput($request->input());
        $request->validate([
            'namaPerusahaan' => 'required',
            'volumeStokProduk' => 'nullable',
            'tonaseStokProduk' => 'nullable',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);


        $stokProdukData = $request->all();

        $user = User::where('namaPerusahaan', $request->namaPerusahaan)->first();
        $stokProdukData['user_id'] = $user->id;

        $stokProduk = StokProduk::create($stokProdukData);
        // dd($stokProduk);
        return redirect()->route('admin.stokProduk.index');
    }

    public function edit($id){
        $stokProduk = StokProduk::find($id);
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

        return view('admin.stokProduk.edit', compact(['stokProduk' ,'perusahaanUser', 'bulan', 'tahun']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'namaPerusahaan' => 'required',
            'volumeStokProduk' => 'nullable',
            'tonaseStokProduk' => 'nullable',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $stokProduk = StokProduk::find($id);
        $stokProdukData = $request->all();

        $user = User::where('namaPerusahaan', $request->namaPerusahaan)->first();

        if ($user) {
            $stokProdukData['user_id'] = $user->id;
        }

        $stokProduk->update($stokProdukData);

        // dd($stokProduk);
        return redirect()->route('admin.stokProduk.index');
    }

    public function destroy($id){
        $stokProduk = StokProduk::find($id);

        $stokProduk->delete();

        return redirect()->route('admin.stokProduk.index');
    }
}
