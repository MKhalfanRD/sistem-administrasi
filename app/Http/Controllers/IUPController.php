<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\IUP;
use Illuminate\Http\Request;

class IUPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $IUP = IUP::all();
        // $scanSK = request()->file('scanSK');
        // $filepath = $scanSK->store('scanSK', 'public');
        // return view('iup.index', compact(['IUP', 'filepath']));
        return view('iup.index', compact(['IUP']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];
        return view('iup.create', compact('tahapanKegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        session()->flashInput($request->input());
        $request->validate([
            'namaPerusahaan' => 'required',
            'alamat'=> 'required',
            'npwp' => 'required',
            'nib' => 'required',
            'kabupaten' => 'required',
            'noSK' => 'required',
            'luasWilayah' => 'nullable|numeric',
            'tahapanKegiatan' => 'required',
            'komoditas' => 'required',
            'tanggalMulai' => 'required',
            'tanggalBerakhir' => 'required',
            'lokasiIzin' => 'required',
            'scanSK' => 'nullable|file|mimes:pdf',
        ]);

        $tanggalMulai = $request->tanggalMulai;
        $tanggalBerakhir = $request->tanggalBerakhir;
        $statusIzin = now()->between($tanggalMulai, $tanggalBerakhir) ? 'Aktif' : 'Tidak Aktif';

        $statusIzin = $statusIzin == 'Aktif' ? 'Aktif' : 'Tidak Aktif';

        $scanSK = request()->file('scanSK');

        if($scanSK){
            $filepath = $scanSK->store('scanSK', 'public');
        }else{
            $filepath = null;
        }

        $iup = IUP::create([
            'namaPerusahaan' => $request->namaPerusahaan,
            'alamat' => $request->alamat,
            'npwp' => $request->npwp,
            'nib' => $request->nib,
            'kabupaten' => $request->kabupaten,
            'noSK' => $request->noSK,
            'luasWilayah' => $request->luasWilayah,
            'tahapanKegiatan' => $request->tahapanKegiatan,
            'komoditas' => $request->komoditas,
            'tanggalMulai' => $request->tanggalMulai,
            'tanggalBerakhir' => $request->tanggalBerakhir,
            'lokasiIzin' => $request->lokasiIzin,
            'statusIzin' => $statusIzin,
            'scanSK' => $filepath,
        ]);

        dd($iup);
        return redirect()->route('iup.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(IUP $iUP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];

        $IUP = IUP::find($id);
        $tahapanKegiatanSelected = $IUP->tahapanKegiatan;
        return view('iup.edit', compact(['IUP', 'tahapanKegiatanSelected', 'tahapanKegiatan']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'namaPerusahaan' => 'required',
            'alamat'=> 'required',
            'npwp' => 'required',
            'nib' => 'required',
            'kabupaten' => 'required',
            'noSK' => 'required',
            'luasWilayah' => 'required|numeric',
            'tahapanKegiatan' => 'required',
            'komoditas' => 'required',
            'tanggalMulai' => 'required',
            'tanggalBerakhir' => 'required',
            'lokasiIzin' => 'required',
            'scanSK' => 'nullable|file|mimes:pdf',
        ]);

        $IUP = IUP::find($id);

        if ($request->hasFile('scanSK')){
            $oldScanSK = $IUP->scanSK;
            Storage::disk('public')->delete($oldScanSK);
            $scanSK = request()->file('scanSK');
            $filepath = $scanSK->store('scanSK', 'public');
        } else {
            $filepath = $IUP->scanSK;
        }

        $IUP->update([
            'namaPerusahaan' => $request->namaPerusahaan,
            'alamat' => $request->alamat,
            'npwp' => $request->npwp,
            'nib' => $request->nib,
            'kabupaten' => $request->kabupaten,
            'noSK' => $request->noSK,
            'luasWilayah' => $request->luasWilayah,
            'tahapanKegiatan' => $request->tahapanKegiatan,
            'komoditas' => $request->komoditas,
            'tanggalMulai' => $request->tanggalMulai,
            'tanggalBerakhir' => $request->tanggalBerakhir,
            'lokasiIzin' => $request->lokasiIzin,
            'statusIzin' => $request->statusIzin,
            'scanSK' => $filepath,
        ]);

        return redirect()->route('iup.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $IUP = IUP::find($id);
        Storage::disk('public')->delete($IUP->scanSK);
        $IUP->delete();

        return redirect()->route('iup.index');
    }
}
