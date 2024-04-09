<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Komoditas;
use App\Models\Produksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminProduksiController extends Controller
{
    public function index(){
        $produksi = Produksi::all();

        return view('admin.produksi.index', compact(['produksi']));
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
        return view('admin.produksi.create', compact(['perusahaanUser', 'komoditas', 'bulan', 'tahun']));
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

        $user = User::where('namaPerusahaan', $request->namaPerusahaan)->first();
        $produksiData['user_id'] = $user->id;

        $produksi = Produksi::create($produksiData);
        // dd($produksi);
        return redirect()->route('admin.produksi.index');
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
        return view('admin.produksi.edit', compact(['produksi', 'perusahaanUser', 'komoditas', 'bulan', 'tahun']));
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

        $user = User::where('namaPerusahaan', $request->namaPerusahaan)->first();

        if ($user) {
            $produksiData['user_id'] = $user->id;
        }

        $produksi->update($produksiData);
        // dd($produksi);
        return redirect()->route('admin.produksi.index');
    }

    public function destroy($id){
        $produksi = Produksi::find($id);

        $produksi->delete();

        return redirect()->route('admin.produksi.index');
    }
}
