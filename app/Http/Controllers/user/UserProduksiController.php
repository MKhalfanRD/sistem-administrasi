<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Komoditas;
use App\Models\Produksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserProduksiController extends Controller
{
    public function index(){
        $produksi = Produksi::all();

        return view('produksi.index', compact(['produksi']));
    }

    public function create(){
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');
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
        return view('produksi.create', compact(['perusahaanUser', 'komoditas', 'bulan', 'tahun']));
    }

    public function store(Request $request){
        session()->flashInput($request->input());
        $request->validate([
            'namaPerusahaan' => 'required',
            'komoditas' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'buktiBayar' => 'nullable|file|mimes:jpg,png',
            'volumeProduksi' => 'nullable',
            'tonaseProduksi' => 'nullable',
        ]);

        $buktiBayar = request()->file('buktiBayar');
        $filepath = $buktiBayar ? $buktiBayar->store('buktiBayar', 'public') : null;

        $produksiData = $request->all();

        $produksiData['buktiBayar'] = $filepath;
        $produksi = Produksi::create($produksiData);
        dd($produksi);
        return redirect()->route('produksi.index');
    }

    public function edit($id){
        $produksi = Produksi::find($id);
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');
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
        return view('produksi.edit', compact(['produksi', 'perusahaanUser', 'komoditas', 'bulan', 'tahun']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'namaPerusahaan' => 'required',
            'komoditas' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'buktiBayar' => 'nullable|file|mimes:jpg,png',
            'volumeProduksi' => 'nullable',
            'tonaseProduksi' => 'nullable',
        ]);

        $produksi = Produksi::find($id);

        $produksiData = $request->except('buktiBayar');

        if ($request->hasFile('buktiBayar')) {
            $buktiBayar = $request->file('buktiBayar');
            $filepath = $buktiBayar->store('buktiBayar', 'public');
            $produksi->buktiBayar = $filepath;
        }

        $produksi->update($produksiData);
        dd($produksi);
        return redirect()->route('produksi.index');
    }

    public function destroy($id){
        $produksi = Produksi::find($id);

        $produksi->delete();

        return redirect()->route('produksi.index');
    }
}
