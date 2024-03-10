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
            'noSK_wiup' => 'nullable',
            'noSK_eksplor' => 'nullable',
            'noSK_op' => 'nullable',
            'noSK_p1' => 'nullable',
            'noSK_p2' => 'nullable',
            'masaBerlaku_eksplor' => 'nullable',
            'masaBerlaku_op' => 'nullable',
            'masaBerlaku_p1' => 'nullable',
            'masaBerlaku_p2' => 'nullable',
            'tanggalSK_wiup' => 'nullable',
            'tanggalSK_eksplor' => 'nullable',
            'tanggalSK_op' => 'nullable',
            'tanggalSK_p1' => 'nullable',
            'tanggalSK_p2' => 'nullable',
            'tanggalBerakhir_eksplor' => 'nullable',
            'tanggalBerakhir_op' => 'nullable',
            'tanggalBerakhir_p1' => 'nullable',
            'tanggalBerakhir_p2' => 'nullable',
            'luasWilayah' => 'nullable|numeric',
            'tahapanKegiatan' => 'required',
            'komoditas' => 'required',
            'lokasiIzin' => 'required',
            'scanSK' => 'nullable|file|mimes:pdf',
        ]);

        $tanggalSK = $request->tanggalSK;
        $tanggalBerakhir = $request->tanggalBerakhir;
        $statusIzin = now()->greaterThanOrEqualTo($tanggalSK) && now()->lessThanOrEqualTo($tanggalBerakhir) || now()->isSameDay($tanggalSK) && now()->isSameDay($tanggalBerakhir) ? 'Aktif' : 'Tidak Aktif';

        $scanSK = request()->file('scanSK');
        $filepath = $scanSK ? $scanSK->store('scanSK', 'public') : null;

        if($request->has('fromModal')){
            if($request->tahapanKegiatan === 'WIUP'){
                $request->validate([
                    'tanggalSK_wiup' => 'nullable',
                    'noSK_wiup' => 'nullable',
                ]);
                IUP::create([
                    'tanggalSK_wiup' => $request->tanggalSK_wiup,
                    'noSK_wiup' => $request->noSK_wiup,
                ]);
            }
            else if($request->tahapanKegiatan === 'IUP Tahap Eksplorasi'){
                $request->validate([
                    'tanggalSK_eksplor' => 'nullable',
                    'noSK_eksplor' => 'nullable',
                    'masaBerlaku_eksplor' => 'nullable',
                    'tanggalBerakhir_eksplor' => 'nullable'
                ]);
                IUP::create([
                    'tanggalSK_eksplor' => $request->tanggalSK_eksplor,
                    'noSK_eksplor' => $request->noSK_eksplor,
                    'masaBerlaku_eksplor' => $request->masaBerlaku_eksplor,
                    'tanggalBerakhir_eksplor'=>$request->tanggalBerakhir_eksplor,
                ]);
            }
            else if($request->tahapanKegiatan === 'IUP Tahap Operasi Produksi'){
                $request->validate([
                    'tanggalSK_op' => 'nullable',
                    'noSK_op' => 'nullable',
                    'masaBerlaku_op' => 'nullable',
                    'tanggalBerakhir_op' => 'nullable'
                ]);
                IUP::create([
                    'tanggalSK_op' => $request->tanggalSK_op,
                    'noSK_op' => $request->noSK_op,
                    'masaBerlaku_op' => $request->masaBerlaku_op,
                    'tanggalBerakhir_op'=>$request->tanggalBerakhir_op,
                ]);
            }
            else if($request->tahapanKegiatan === 'Perpanjangan 1 IUP Tahap Operasi Produksi'){
                $request->validate([
                    'tanggalSK_p1' => 'nullable',
                    'noSK_p1' => 'nullable',
                    'masaBerlaku_p1' => 'nullable',
                    'tanggalBerakhir_p1' => 'nullable'
                ]);
                IUP::create([
                    'tanggalSK_p1' => $request->tanggalSK_p1,
                    'noSK_p1' => $request->noSK_p1,
                    'masaBerlaku_p1' => $request->masaBerlaku_p1,
                    'tanggalBerakhir_p1'=>$request->tanggalBerakhir_p1,
                ]);
            }
            else if($request->tahapanKegiatan === 'Perpanjangan 2 IUP Tahap Operasi Produksi'){
                $request->validate([
                    'tanggalSK_p2' => 'nullable',
                    'noSK_p2' => 'nullable',
                    'masaBerlaku_p2' => 'nullable',
                    'tanggalBerakhir_p2' => 'nullable'
                ]);
                IUP::create([
                    'tanggalSK_p2' => $request->tanggalSK_p2,
                    'noSK_p2' => $request->noSK_p2,
                    'masaBerlaku_p2' => $request->masaBerlaku_p2,
                    'tanggalBerakhir_p2'=>$request->tanggalBerakhir_p2,
                ]);
            }
        }

        $iup = IUP::create([
            'namaPerusahaan' => $request->namaPerusahaan,
            'alamat' => $request->alamat,
            'npwp' => $request->npwp,
            'nib' => $request->nib,
            'kabupaten' => $request->kabupaten,
            'noSK_wiup' => $request->noSK_wiup,
            'noSK_eksplor' => $request->noSK_eksplor,
            'noSK_op' => $request->noSK_op,
            'noSK_p1' => $request->noSK_p1,
            'noSK_p2' => $request->noSK_p2,
            'luasWilayah' => $request->luasWilayah,
            'tahapanKegiatan' => $request->tahapanKegiatan,
            'masaBerlaku_eksplor' => $request->masaBerlaku_eksplor,
            'masaBerlaku_op' => $request->masaBerlaku_op,
            'masaBerlaku_p1' => $request->masaBerlaku_p1,
            'masaBerlaku_p2' => $request->masaBerlaku_p2,
            'komoditas' => $request->komoditas,
            'tanggalSK_wiup' => $request->tanggalSK_wiup,
            'tanggalSK_eksplor' => $request->tanggalSK_eksplor,
            'tanggalSK_op' => $request->tanggalSK_op,
            'tanggalSK_p1' => $request->tanggalSK_p1,
            'tanggalSK_p2' => $request->tanggalSK_p2,
            'tanggalBerakhir_eksplor' => $request->tanggalBerakhir_eksplor,
            'tanggalBerakhir_op' => $request->tanggalBerakhir_op,
            'tanggalBerakhir_p1' => $request->tanggalBerakhir_p1,
            'tanggalBerakhir_p2' => $request->tanggalBerakhir_p2,
            'lokasiIzin' => $request->lokasiIzin,
            'statusIzin' => $statusIzin,
            'scanSK' => $filepath,
        ]);

        // dd($tanggalMulai, $tanggalBerakhir, now());
        // dd($iup);
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
        session()->flashInput($request->input());
        $request->validate([
            'namaPerusahaan' => 'required',
            'alamat'=> 'required',
            'npwp' => 'required',
            'nib' => 'required',
            'kabupaten' => 'required',
            'noSK_wiup' => 'nullable',
            'noSK_eksplor' => 'nullable',
            'noSK_op' => 'nullable',
            'noSK_p1' => 'nullable',
            'noSK_p2' => 'nullable',
            'masaBerlaku_eksplor' => 'nullable',
            'masaBerlaku_op' => 'nullable',
            'masaBerlaku_p1' => 'nullable',
            'masaBerlaku_p2' => 'nullable',
            'tanggalSK_wiup' => 'nullable',
            'tanggalSK_eksplor' => 'nullable',
            'tanggalSK_op' => 'nullable',
            'tanggalSK_p1' => 'nullable',
            'tanggalSK_p2' => 'nullable',
            'tanggalBerakhir_eksplor' => 'nullable',
            'tanggalBerakhir_op' => 'nullable',
            'tanggalBerakhir_p1' => 'nullable',
            'tanggalBerakhir_p2' => 'nullable',
            'luasWilayah' => 'nullable|numeric',
            'tahapanKegiatan' => 'required',
            'komoditas' => 'required',
            'lokasiIzin' => 'required',
            'scanSK' => 'nullable|file|mimes:pdf',
        ]);

        $tanggalSK = $request->tanggalSK;
        $tanggalBerakhir = $request->tanggalBerakhir;
        $statusIzin = now()->greaterThanOrEqualTo($tanggalSK) && now()->lessThanOrEqualTo($tanggalBerakhir) || now()->isSameDay($tanggalSK) && now()->isSameDay($tanggalBerakhir) ? 'Aktif' : 'Tidak Aktif';

        $scanSK = request()->file('scanSK');
        $filepath = $scanSK ? $scanSK->store('scanSK', 'public') : null;

        if($request->has('fromModal')){
            if($request->tahapanKegiatan === 'WIUP'){
                $request->validate([
                    'tanggalSK_wiup' => 'nullable',
                    'noSK_wiup' => 'nullable',
                ]);
                IUP::create([
                    'tanggalSK_wiup' => $request->tanggalSK_wiup,
                    'noSK_wiup' => $request->noSK_wiup,
                ]);
            }
            else if($request->tahapanKegiatan === 'IUP Tahap Eksplorasi'){
                $request->validate([
                    'tanggalSK_eksplor' => 'nullable',
                    'noSK_eksplor' => 'nullable',
                    'masaBerlaku_eksplor' => 'nullable',
                    'tanggalBerakhir_eksplor' => 'nullable'
                ]);
                IUP::create([
                    'tanggalSK_eksplor' => $request->tanggalSK_eksplor,
                    'noSK_eksplor' => $request->noSK_eksplor,
                    'masaBerlaku_eksplor' => $request->masaBerlaku_eksplor,
                    'tanggalBerakhir_eksplor'=>$request->tanggalBerakhir_eksplor,
                ]);
            }
            else if($request->tahapanKegiatan === 'IUP Tahap Operasi Produksi'){
                $request->validate([
                    'tanggalSK_op' => 'nullable',
                    'noSK_op' => 'nullable',
                    'masaBerlaku_op' => 'nullable',
                    'tanggalBerakhir_op' => 'nullable'
                ]);
                IUP::create([
                    'tanggalSK_op' => $request->tanggalSK_op,
                    'noSK_op' => $request->noSK_op,
                    'masaBerlaku_op' => $request->masaBerlaku_op,
                    'tanggalBerakhir_op'=>$request->tanggalBerakhir_op,
                ]);
            }
            else if($request->tahapanKegiatan === 'Perpanjangan 1 IUP Tahap Operasi Produksi'){
                $request->validate([
                    'tanggalSK_p1' => 'nullable',
                    'noSK_p1' => 'nullable',
                    'masaBerlaku_p1' => 'nullable',
                    'tanggalBerakhir_p1' => 'nullable'
                ]);
                IUP::create([
                    'tanggalSK_p1' => $request->tanggalSK_p1,
                    'noSK_p1' => $request->noSK_p1,
                    'masaBerlaku_p1' => $request->masaBerlaku_p1,
                    'tanggalBerakhir_p1'=>$request->tanggalBerakhir_p1,
                ]);
            }
            else if($request->tahapanKegiatan === 'Perpanjangan 2 IUP Tahap Operasi Produksi'){
                $request->validate([
                    'tanggalSK_p2' => 'nullable',
                    'noSK_p2' => 'nullable',
                    'masaBerlaku_p2' => 'nullable',
                    'tanggalBerakhir_p2' => 'nullable'
                ]);
                IUP::create([
                    'tanggalSK_p2' => $request->tanggalSK_p2,
                    'noSK_p2' => $request->noSK_p2,
                    'masaBerlaku_p2' => $request->masaBerlaku_p2,
                    'tanggalBerakhir_p2'=>$request->tanggalBerakhir_p2,
                ]);
            }
        }

        $iup = IUP::create([
            'namaPerusahaan' => $request->namaPerusahaan,
            'alamat' => $request->alamat,
            'npwp' => $request->npwp,
            'nib' => $request->nib,
            'kabupaten' => $request->kabupaten,
            'noSK_wiup' => $request->noSK_wiup,
            'noSK_eksplor' => $request->noSK_eksplor,
            'noSK_op' => $request->noSK_op,
            'noSK_p1' => $request->noSK_p1,
            'noSK_p2' => $request->noSK_p2,
            'luasWilayah' => $request->luasWilayah,
            'tahapanKegiatan' => $request->tahapanKegiatan,
            'masaBerlaku_eksplor' => $request->masaBerlaku_eksplor,
            'masaBerlaku_op' => $request->masaBerlaku_op,
            'masaBerlaku_p1' => $request->masaBerlaku_p1,
            'masaBerlaku_p2' => $request->masaBerlaku_p2,
            'komoditas' => $request->komoditas,
            'tanggalSK_wiup' => $request->tanggalSK_wiup,
            'tanggalSK_eksplor' => $request->tanggalSK_eksplor,
            'tanggalSK_op' => $request->tanggalSK_op,
            'tanggalSK_p1' => $request->tanggalSK_p1,
            'tanggalSK_p2' => $request->tanggalSK_p2,
            'tanggalBerakhir_eksplor' => $request->tanggalBerakhir_eksplor,
            'tanggalBerakhir_op' => $request->tanggalBerakhir_op,
            'tanggalBerakhir_p1' => $request->tanggalBerakhir_p1,
            'tanggalBerakhir_p2' => $request->tanggalBerakhir_p2,
            'lokasiIzin' => $request->lokasiIzin,
            'statusIzin' => $statusIzin,
            'scanSK' => $filepath,
        ]);

        // dd($IUP);

        return redirect()->route('iup.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $IUP = IUP::find($id);

        if (!is_null($IUP->scanSK)) {
        Storage::disk('public')->delete($IUP->scanSK);
        }

        $IUP->delete();

        return redirect()->route('iup.index');
    }

}
