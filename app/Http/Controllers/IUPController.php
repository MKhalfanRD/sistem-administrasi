<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Storage;
use App\Models\IUP;
use App\Models\WIUP;
use App\Models\Eksplorasi;
use App\Models\OperasiProduksi;
use App\Models\Perpanjangan1;
use App\Models\Perpanjangan2;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class IUPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $IUP = IUP::all();
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];
        return view('iup.index', compact(['IUP', 'tahapanKegiatan']));
    }

    public function print(Request $request, $tahapanKegiatan)
    {
        $validTahapan = [
            'WIUP',
            'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi'
        ];

        // Pastikan jenis tahapan kegiatan yang diminta valid
        if (!in_array($tahapanKegiatan, $validTahapan)) {
            abort(404);
        }

        // Ambil data sesuai dengan jenis tahapan kegiatan yang dipilih
        $data = IUP::whereIn('tahapanKegiatan', [$tahapanKegiatan])->get();
        dd($tahapanKegiatan);
        return view('print.index', compact('data'));
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

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');

        return view('iup.create', compact('tahapanKegiatan', 'perusahaanUser', 'kabupaten'));
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
            'tahapanKegiatan' => 'nullable',
            'komoditas' => 'required',
            'lokasiIzin' => 'required',
            'statusIzin' => 'nullable',
            'scanSK' => 'nullable|file|mimes:pdf',
        ]);

        $iupData = $request->only([
            'namaPerusahaan', 'alamat', 'npwp', 'nib', 'kabupaten',
            'noSK_wiup', 'noSK_eksplor', 'noSK_op', 'noSK_p1', 'noSK_p2',
            'luasWilayah', 'tahapanKegiatan', 'masaBerlaku_eksplor', 'masaBerlaku_op',
            'masaBerlaku_p1', 'masaBerlaku_p2', 'komoditas', 'tanggalSK_wiup',
            'tanggalSK_eksplor', 'tanggalSK_op', 'tanggalSK_p1', 'tanggalSK_p2',
            'tanggalBerakhir_eksplor', 'tanggalBerakhir_op', 'tanggalBerakhir_p1',
            'tanggalBerakhir_p2', 'lokasiIzin', 'statusIzin', 'scanSK',
        ]);

        $tahapanKegiatan = $request->tahapanKegiatan;
        $iup = new IUP;

        $scanSK = $request->file('scanSK');
        $filepath = $scanSK ? $scanSK->store('scanSK', 'public') : null;
        $iupData['scanSK'] = $filepath;

        $statusIzin = null;
        
        if ($request->has('fromModal')) {
            switch ($request->tahapanKegiatan) {
                case 'WIUP':
                    $request->validate([
                        'tanggalSK_wiup' => 'nullable',
                        'noSK_wiup' => 'nullable',
                    ]);
                    $iupData['tanggalSK_wiup'] = $request->tanggalSK_wiup;
                    $iupData['noSK_wiup'] = $request->noSK_wiup;
                    $tahapanKegiatan = 'WIUP';
                    $wiup = new WIUP;
                    $statusIzin = $wiup->getStatusIzin($tahapanKegiatan);
                    $wiup = WIUP::create($iupData);
                    break;
                case 'IUP Tahap Eksplorasi':
                    $request->validate([
                        'tanggalSK_eksplor' => 'nullable',
                        'noSK_eksplor' => 'nullable',
                        'masaBerlaku_eksplor' => 'nullable',
                        'tanggalBerakhir_eksplor' => 'nullable'
                    ]);
                    $iupData['tanggalSK_eksplor'] = $request->tanggalSK_eksplor;
                    $iupData['noSK_eksplor'] = $request->noSK_eksplor;
                    $iupData['masaBerlaku_eksplor'] = $request->masaBerlaku_eksplor;
                    $iupData['tanggalBerakhir_eksplor'] = $request->tanggalBerakhir_eksplor;
                    $tahapanKegiatan = 'IUP Tahap Eksplorasi';
                    $eksplorasi = new Eksplorasi;
                    $statusIzin = $eksplorasi->getStatusIzin($tahapanKegiatan);
                    $eksplorasi = Eksplorasi::create($iupData);
                    break;
                case 'IUP Tahap Operasi Produksi':
                    $request->validate([
                        'tanggalSK_op' => 'nullable',
                        'noSK_op' => 'nullable',
                        'masaBerlaku_op' => 'nullable',
                        'tanggalBerakhir_op' => 'nullable'
                    ]);
                    $iupData['tanggalSK_op'] = $request->tanggalSK_op;
                    $iupData['noSK_op'] = $request->noSK_op;
                    $iupData['masaBerlaku_op'] = $request->masaBerlaku_op;
                    $iupData['tanggalBerakhir_op'] = $request->tanggalBerakhir_op;
                    $tahapanKegiatan = 'IUP Tahap Operasi Produksi';
                    $operasiProduksi = new OperasiProduksi;
                    $statusIzin = $operasiProduksi->getStatusIzin($tahapanKegiatan);
                    $operasiProduksi = OperasiProduksi::create($iupData);
                    break;
                case 'Perpanjangan 1 IUP Tahap Operasi Produksi':
                    $request->validate([
                        'tanggalSK_p1' => 'nullable',
                        'noSK_p1' => 'nullable',
                        'masaBerlaku_p1' => 'nullable',
                        'tanggalBerakhir_p1' => 'nullable'
                    ]);
                    $iupData['tanggalSK_p1'] = $request->tanggalSK_p1;
                    $iupData['noSK_p1'] = $request->noSK_p1;
                    $iupData['masaBerlaku_p1'] = $request->masaBerlaku_p1;
                    $iupData['tanggalBerakhir_p1'] = $request->tanggalBerakhir_p1;
                    $tahapanKegiatan = 'Perpanjangan 1 IUP Tahap Operasi Produksi';
                    $perpanjangan1 = new Perpanjangan1;
                    $statusIzin = $perpanjangan1->getStatusIzin($tahapanKegiatan);
                    $perpanjangan1 = Perpanjangan1::create($iupData);
                    break;
                case 'Perpanjangan 2 IUP Tahap Operasi Produksi':
                    $request->validate([
                        'tanggalSK_p2' => 'nullable',
                        'noSK_p2' => 'nullable',
                        'masaBerlaku_p2' => 'nullable',
                        'tanggalBerakhir_p2' => 'nullable'
                    ]);
                    $iupData['tanggalSK_p2'] = $request->tanggalSK_p2;
                    $iupData['noSK_p2'] = $request->noSK_p2;
                    $iupData['masaBerlaku_p2'] = $request->masaBerlaku_p2;
                    $iupData['tanggalBerakhir_p2'] = $request->tanggalBerakhir_p2;
                    $tahapanKegiatan = 'Perpanjangan 2 IUP Tahap Operasi Produksi';
                    $perpanjangan2 = new Perpanjangan2;
                    $statusIzin = $perpanjangan2->getStatusIzin($request->tahapanKegiatan);
                    $perpanjangan2 = Perpanjangan2::create($iupData);
                    break;
                default:
                    break;
            }
        }

        $iupData['statusIzin'] = $statusIzin ?? 'Tidak Aktif';

        $iup = IUP::create($iupData);
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

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');

        $IUP = IUP::find($id);
        $tahapanKegiatanSelected = $IUP->tahapanKegiatan;
        // $data = IUP::find($id);
        return view('iup.edit', compact(['IUP', 'tahapanKegiatanSelected', 'tahapanKegiatan', 'perusahaanUser', 'kabupaten']));
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
            'tahapanKegiatan' => 'nullable',
            'komoditas' => 'required',
            'lokasiIzin' => 'required',
            'statusIzin' => 'nullable',
            'scanSK' => 'nullable|file|mimes:pdf',
        ]);

        $iup = IUP::findOrFail($id);

        $iupData = $request->only([
            'namaPerusahaan', 'alamat', 'npwp', 'nib', 'kabupaten',
            'noSK_wiup', 'noSK_eksplor', 'noSK_op', 'noSK_p1', 'noSK_p2',
            'luasWilayah', 'tahapanKegiatan', 'masaBerlaku_eksplor', 'masaBerlaku_op',
            'masaBerlaku_p1', 'masaBerlaku_p2', 'komoditas', 'tanggalSK_wiup',
            'tanggalSK_eksplor', 'tanggalSK_op', 'tanggalSK_p1', 'tanggalSK_p2',
            'tanggalBerakhir_eksplor', 'tanggalBerakhir_op', 'tanggalBerakhir_p1',
            'tanggalBerakhir_p2', 'lokasiIzin', 'statusIzin', 'scanSK',
        ]);

        $tahapanKegiatan = $request->tahapanKegiatan;
        $iupModel = new IUP;
        $iupData['statusIzin'] = $iupModel->getStatusIzin($tahapanKegiatan);

        switch ($request->tahapanKegiatan) {
            case 'WIUP':
                $wiup = new WIUP;
                $iupData['statusIzin'] = $wiup->getStatusIzin($tahapanKegiatan);
                break;
            case 'IUP Tahap Eksplorasi':
                $eksplorasi = new Eksplorasi;
                $iupData['statusIzin'] = $eksplorasi->getStatusIzin($tahapanKegiatan);
                break;
            case 'IUP Tahap Operasi Produksi':
                $operasiProduksi = new OperasiProduksi;
                $iupData['statusIzin'] = $operasiProduksi->getStatusIzin($tahapanKegiatan);
                break;
            case 'Perpanjangan 1 IUP Tahap Operasi Produksi':
                $perpanjangan1 = new Perpanjangan1;
                $iupData['statusIzin'] = $perpanjangan1->getStatusIzin($tahapanKegiatan);
                break;
            case 'Perpanjangan 2 IUP Tahap Operasi Produksi':
                $perpanjangan2 = new Perpanjangan2;
                $iupData['statusIzin'] = $perpanjangan2->getStatusIzin($request->tahapanKegiatan);
                break;
        }

        if (array_key_exists('statusIzin', $iupData) && $iup->getStatusIzin($tahapanKegiatan) === $iupData['statusIzin']) {
            unset($iupData['statusIzin']);
        }

        $iup->update($iupData);

        if ($request->has('fromModal') && empty($request->all())) {
            return redirect()->back()->with('status', 'Tidak ada perubahan yang dilakukan.');
        }

        if ($request->hasFile('scanSK')) {
            $scanSK = $request->file('scanSK');
            $filepath = $scanSK->store('scanSK', 'public');
            $iup->scanSK = $filepath;
            $iup->save();
        }
        // dd($iup);
        return redirect()->route('iup.index')->with('status', 'Data berhasil diperbarui.');
    }


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
