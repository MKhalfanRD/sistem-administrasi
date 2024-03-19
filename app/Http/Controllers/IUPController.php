<?php

namespace App\Http\Controllers;

use App\Exports\IupExport;
use App\Models\Kabupaten;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use App\Models\IUP;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IUPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd($request->all());
        // dd($request->all());

        // $search = new IUP;

        // if ($request->get('search')) {
        //     $search = $search->where('namaPerusahaan', 'LIKE', '%' . $request->get('search') . '%')
        //     ->orWhere('npwp', 'LIKE', '%' . $request->get('search') . '%')
        //     ->orWhere('nib', 'LIKE', '%' . $request->get('search') . '%')
        //     ->orWhere('tahapanKegiatan', 'LIKE', '%' . $request->get('search') . '%');
        // }

        // $search = $search->get();

        // return view('iup.index', compact('search', 'request'));
        // return view('iup.index', compact(['IUP', 'search', 'request']));
        $iup = IUP::all();
        return view('iup.index', compact(['iup']));
    }

    public function export()
    {
        return Excel::download(new IupExport, 'data_iup.xlsx');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $iup = IUP::where(function($query) use ($search){
            $query->where('namaPerusahaan', 'like', "%$search%")
            ->orWhere('alamat', 'like', "%$search%")
            ->orWhere('npwp', 'like', "%$search%")
            ->orWhere('nib', 'like', "%$search%")
            ->orWhere('tahapanKegiatan', 'like', "%$search%");
        })->get();

        return view('iup.index', compact('search', 'iup'));

        // dd($request->all());

        // $search = new IUP;

        // if ($request->get('search')) {
        //     $search = $search->where('namaPerusahaan', 'LIKE', '%' . $request->get('search') . '%')
        //     ->orWhere('npwp', 'LIKE', '%' . $request->get('search') . '%')
        //     ->orWhere('nib', 'LIKE', '%' . $request->get('search') . '%')
        //     ->orWhere('tahapanKegiatan', 'LIKE', '%' . $request->get('search') . '%');
        // }

        // $search = $search->get();

        // return view('iup.index', compact('search', 'request'));
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
            'alamat' => 'required',
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
            'scanSK' => 'nullable|file|mimes:pdf',
        ]);

        $tanggalSK = $request->tanggalSK;
        $tanggalBerakhir = $request->tanggalBerakhir;

        $scanSK = request()->file('scanSK');
        $filepath = $scanSK ? $scanSK->store('scanSK', 'public') : null;

        $jenisKegiatan = '';
        $tahapanKegiatan = $request->tahapanKegiatan;
        switch ($tahapanKegiatan) {
            case 'WIUP':
                $tanggalSK = $request->tanggalSK_wiup;
                $noSK = $request->noSK_wiup;
                $jenisKegiatan = 'wiup';
                break;
            case 'IUP Tahap Eksplorasi':
                $tanggalSK = $request->tanggalSK_eksplor;
                $tanggalBerakhir = $request->tanggalBerakhir_eksplor;
                $jenisKegiatan = 'eksplor';
                break;
            case 'IUP Tahap Operasi Produksi':
                $tanggalSK = $request->tanggalSK_op;
                $tanggalBerakhir = $request->tanggalBerakhir_op;
                $jenisKegiatan = 'op';
                break;
            case 'Perpanjangan 1 IUP Tahap Operasi Produksi':
                $tanggalSK = $request->tanggalSK_p1;
                $tanggalBerakhir = $request->tanggalBerakhir_p1;
                $jenisKegiatan = 'p1';
                break;
            case 'Perpanjangan 2 IUP Tahap Operasi Produksi':
                $tanggalSK = $request->tanggalSK_p2;
                $tanggalBerakhir = $request->tanggalBerakhir_p2;
                $jenisKegiatan = 'p2';
                break;
            default:
                $tanggalSK = null;
                $tanggalBerakhir = null;
                break;
        }

        $statusIzin = $tahapanKegiatan === 'WIUP' && $tanggalSK && now()->gte($tanggalSK) ? 'Aktif' : 'Tidak Aktif';

        if ($tahapanKegiatan !== 'WIUP') {
            $statusIzin = $tanggalSK && $tanggalBerakhir ? (now()->gte($tanggalSK) && now()->lte($tanggalBerakhir) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
        }

        $iupData = $request->except('fromModal', 'scanSK');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['scanSK'] = $filepath;
        $iupData['jenisKegiatan'] = $jenisKegiatan;
        // dd($jenisKegiatan);

        $iup = IUP::create($iupData);

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
        // dd($request->all());
        $request->validate([
            'namaPerusahaan' => 'required',
            'alamat' => 'required',
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
            'scanSK' => 'nullable|file|mimes:pdf',
        ]);

        $iup = IUP::find($id);

        $tahapanKegiatan = $iup->tahapanKegiatan;
        switch ($tahapanKegiatan) {
            case 'WIUP':
                $tanggalSK = $request->tanggalSK_wiup;
                $noSK = $request->noSK_wiup;
                $jenisKegiatan = 'wiup';
                $statusIzin = now()->gte($tanggalSK) ? 'Aktif' : 'Tidak Aktif';

                break;
            case 'IUP Tahap Eksplorasi':
                $tanggalSK = $request->tanggalSK_eksplor;
                $tanggalBerakhir = $request->tanggalBerakhir_eksplor;
                $jenisKegiatan = 'eksplor';
                $statusIzin = $tanggalSK && $tanggalBerakhir ? (now()->gte($tanggalSK) && now()->lte($tanggalBerakhir) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
                break;
            case 'IUP Tahap Operasi Produksi':
                $tanggalSK = $request->tanggalSK_op;
                $tanggalBerakhir = $request->tanggalBerakhir_op;
                $jenisKegiatan = 'op';
                $statusIzin = $tanggalSK && $tanggalBerakhir ? (now()->gte($tanggalSK) && now()->lte($tanggalBerakhir) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
                break;
            case 'Perpanjangan 1 IUP Tahap Operasi Produksi':
                $tanggalSK = $request->tanggalSK_p1;
                $tanggalBerakhir = $request->tanggalBerakhir_p1;
                $jenisKegiatan = 'p1';
                $statusIzin = $tanggalSK && $tanggalBerakhir ? (now()->gte($tanggalSK) && now()->lte($tanggalBerakhir) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
                break;
            case 'Perpanjangan 2 IUP Tahap Operasi Produksi':
                $tanggalSK = $request->tanggalSK_p2;
                $tanggalBerakhir = $request->tanggalBerakhir_p2;
                $jenisKegiatan = 'p2';
                $statusIzin = $tanggalSK && $tanggalBerakhir ? (now()->gte($tanggalSK) && now()->lte($tanggalBerakhir) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
                break;
            default:
                $tanggalSK = null;
                $tanggalBerakhir = null;
                break;
        }

        // $statusIzin = $tahapanKegiatan === 'WIUP' && $tanggalSK && now()->gte($tanggalSK) ? 'Aktif' : 'Tidak Aktif';

        // if ($tahapanKegiatan !== 'WIUP') {
        //     $statusIzin = $tanggalSK && $tanggalBerakhir ? (now()->gte($tanggalSK) && now()->lte($tanggalBerakhir) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
        // }

        $iupData = $request->except('fromModal', 'scanSK');
        $iupData['statusIzin'] = $statusIzin;
        // $iupData['scanSK'] = $filepath;
        $iupData['jenisKegiatan'] = $jenisKegiatan;

        // $tanggalSK = $iup->getAttribute("tanggalSK_".$iup->jenisKegiatan);
        // $tanggalBerakhir = $iup->getAttribute("tanggalBerakhir_".$iup->jenisKegiatan);
        // dd($tanggalSK, $tanggalBerakhir);
        // // Recalculate statusIzin based on the updated attributes
        // $statusIzin = $tahapanKegiatan === 'WIUP' && $tanggalSK && now()->gte($tanggalSK) ? 'Aktif' : 'Tidak Aktif';

        // if ($tahapanKegiatan !== 'WIUP') {
        //     $statusIzin = $tanggalSK && $tanggalBerakhir ? (now()->gte($tanggalSK) && now()->lte($tanggalBerakhir) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
        // }

        // $iupData = $request->except('fromModal', 'scanSK');
        // $iupData['statusIzin'] = $statusIzin;

        // // Save the updated row
        // $iup->save();

        // $iup->statusIzin = $request->statusIzin;

        if ($request->hasFile('scanSK')) {
            $scanSK = $request->file('scanSK');
            $filepath = $scanSK->store('scanSK', 'public');
            $iup->scanSK = $filepath;
        }
        $iup->update($iupData);

        // $iup->save();
        // $iup->statusIzin;

        // dd($iup);
        return redirect()->route('iup.index')->with('status', 'Data berhasil diperbarui.');
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
