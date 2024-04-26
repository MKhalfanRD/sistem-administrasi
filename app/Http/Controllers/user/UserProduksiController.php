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
        $user = auth()->user();
        $produksi = Produksi::where('user_id', auth()->user()->id)->get();

        return view('users.produksi.index', compact(['produksi']));
    }

    public function getKomoditas($golongan)
    {
        $data = Komoditas::where('golongan', $golongan)->get();
        return response()->json($data);
    }

    public function edit($id){
        $golongan= [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

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
        return view('users.produksi.edit', compact(['produksi', 'perusahaanUser', 'komoditas', 'bulan', 'tahun', 'golongan']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'namaPerusahaan' => 'nullable',
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
        return redirect()->route('user.produksi.index');
    }
}
