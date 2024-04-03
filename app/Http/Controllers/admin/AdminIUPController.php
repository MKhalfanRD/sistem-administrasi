<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Exports\IupExport;
use App\Models\Kabupaten;
use App\Models\Komoditas;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use App\Models\IUP;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminIUPController extends Controller
{
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
        return view('admin/iup.index', compact(['iup']));
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

        return view('admin.iup.index', compact('search', 'iup'));

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

    public function wiup(){
        $iup = IUP::all();
        $wiup = IUP::where('tahapanKegiatan', 'WIUP')->get();

        return view('admin.iup/wiup.index', compact(['iup','wiup']));
    }

    public function wiupCreate(){
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        return view('admin.iup/wiup.create', compact('tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2'));
    }

    public function wiupStore(Request $request){
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
        ]);

        $tanggalSK = $request->tanggalSK;
        $tanggalBerakhir = $request->tanggalBerakhir;

        $scanSK_wiup = request()->file('scanSK_wiup');
        $filepath_wiup = $scanSK_wiup ? $scanSK_wiup->store('scanSK_wiup', 'public') : null;

        $scanSK_eksplor = request()->file('scanSK_eksplor');
        $filepath_eksplor = $scanSK_eksplor ? $scanSK_eksplor->store('scanSK_eksplor', 'public') : null;

        $scanSK_op = request()->file('scanSK_op');
        $filepath_op = $scanSK_op ? $scanSK_op->store('scanSK_op', 'public') : null;

        $scanSK_p1 = request()->file('scanSK_p1');
        $filepath_p1 = $scanSK_p1 ? $scanSK_p1->store('scanSK_p1', 'public') : null;

        $scanSK_p2 = request()->file('scanSK_p2');
        $filepath_p2 = $scanSK_p2 ? $scanSK_p2->store('scanSK_p2', 'public') : null;

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

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['scanSK_wiup'] = $filepath_wiup;
        $iupData['scanSK_eksplor'] = $filepath_eksplor;
        $iupData['scanSK_op'] = $filepath_op;
        $iupData['scanSK_p1'] = $filepath_p1;
        $iupData['scanSK_p2'] = $filepath_p2;
        $iupData['jenisKegiatan'] = $jenisKegiatan;
        // dd($jenisKegiatan);

        $iup = IUP::create($iupData);
        dd($iup);
        return redirect()->route('admin.wiup.index');
    }
    public function wiupEdit($id){
        $wiup = IUP::find($id);
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        $IUP = IUP::find($id);
        $golonganSelectedWiup = $IUP->golongan_wiup;
        $golonganSelectedEksplor = $IUP->golongan_eksplor;
        $golonganSelectedOp = $IUP->golongan_op;
        $golonganSelectedP1 = $IUP->golongan_p1;
        $golonganSelectedP2 = $IUP->golongan_p2;

        // $data = IUP::find($id);
        return view('admin.iup/wiup.edit', compact(['IUP', 'wiup', 'tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2', 'golonganSelectedWiup', 'golonganSelectedEksplor', 'golonganSelectedOp', 'golonganSelectedP1', 'golonganSelectedP2']));
    }

    public function wiupUpdate(Request $request, $id){
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
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

        if ($request->hasFile('scanSK_wiup')) {
            $scanSK_wiup = $request->file('scanSK_wiup');
            $filepath_wiup = $scanSK_wiup->store('scanSK_wiup', 'public');
            $iup->scanSK_wiup = $filepath_wiup;
        }
        if ($request->hasFile('scanSK_eksplor')) {
            $scanSK_eksplor = $request->file('scanSK_eksplor');
            $filepath_eksplor = $scanSK_eksplor->store('scanSK_eksplor', 'public');
            $iup->scanSK_eksplor = $filepath_eksplor;
        }
        if ($request->hasFile('scanSK_op')) {
            $scanSK_op = $request->file('scanSK_op');
            $filepath_op = $scanSK_op->store('scanSK_op', 'public');
            $iup->scanSK_op = $filepath_op;
        }
        if ($request->hasFile('scanSK_p1')) {
            $scanSK_p1 = $request->file('scanSK_p1');
            $filepath_p1 = $scanSK_p1->store('scanSK_p1', 'public');
            $iup->scanSK_p1 = $filepath_p1;
        }
        if ($request->hasFile('scanSK_p2')) {
            $scanSK_p2 = $request->file('scanSK_p2');
            $filepath_p2 = $scanSK_p2->store('scanSK_p2', 'public');
            $iup->scanSK_p2 = $filepath_p2;
        }

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['jenisKegiatan'] = $jenisKegiatan;

        $iup->update($iupData);
        dd($iup);
        return redirect()->route('admin.wiup.index');
    }

    public function wiupDestroy($id){
        $IUP = IUP::find($id);

        if (!is_null($IUP->scanSK)) {
            Storage::disk('public')->delete($IUP->scanSK);
        }

        $IUP->delete();

        return redirect()->route('admin.wiup.index');
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////eksplorasi///////////////////////////////////
    ///////////////////////////////////////////////////////////////////
    public function eksplor(){
        $iup = IUP::all();
        $eksplor = IUP::where('tahapanKegiatan', 'IUP Tahap Eksplorasi')->get();

        return view('admin.iup/eksplor.index', compact(['iup','eksplor']));
    }

    public function eksplorCreate(){
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        return view('admin.iup/eksplor.create', compact('tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2'));
    }

    public function eksplorStore(Request $request){
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
        ]);

        $tanggalSK = $request->tanggalSK;
        $tanggalBerakhir = $request->tanggalBerakhir;

        $scanSK_wiup = request()->file('scanSK_wiup');
        $filepath_wiup = $scanSK_wiup ? $scanSK_wiup->store('scanSK_wiup', 'public') : null;

        $scanSK_eksplor = request()->file('scanSK_eksplor');
        $filepath_eksplor = $scanSK_eksplor ? $scanSK_eksplor->store('scanSK_eksplor', 'public') : null;

        $scanSK_op = request()->file('scanSK_op');
        $filepath_op = $scanSK_op ? $scanSK_op->store('scanSK_op', 'public') : null;

        $scanSK_p1 = request()->file('scanSK_p1');
        $filepath_p1 = $scanSK_p1 ? $scanSK_p1->store('scanSK_p1', 'public') : null;

        $scanSK_p2 = request()->file('scanSK_p2');
        $filepath_p2 = $scanSK_p2 ? $scanSK_p2->store('scanSK_p2', 'public') : null;

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

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['scanSK_wiup'] = $filepath_wiup;
        $iupData['scanSK_eksplor'] = $filepath_eksplor;
        $iupData['scanSK_op'] = $filepath_op;
        $iupData['scanSK_p1'] = $filepath_p1;
        $iupData['scanSK_p2'] = $filepath_p2;
        $iupData['jenisKegiatan'] = $jenisKegiatan;
        // dd($jenisKegiatan);

        $iup = IUP::create($iupData);
        return redirect()->route('admin.eksplor.index');
    }
    public function eksplorEdit($id){
        $eksplor = IUP::find($id);
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        $IUP = IUP::find($id);
        $golonganSelectedWiup = $IUP->golongan_wiup;
        $golonganSelectedEksplor = $IUP->golongan_eksplor;
        $golonganSelectedOp = $IUP->golongan_op;
        $golonganSelectedP1 = $IUP->golongan_p1;
        $golonganSelectedP2 = $IUP->golongan_p2;

        // $data = IUP::find($id);
        return view('admin.iup/eksplor.edit', compact(['IUP', 'eksplor', 'tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2', 'golonganSelectedWiup', 'golonganSelectedEksplor', 'golonganSelectedOp', 'golonganSelectedP1', 'golonganSelectedP2']));
    }

    public function eksplorUpdate(Request $request, $id){
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
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

        if ($request->hasFile('scanSK_wiup')) {
            $scanSK_wiup = $request->file('scanSK_wiup');
            $filepath_wiup = $scanSK_wiup->store('scanSK_wiup', 'public');
            $iup->scanSK_wiup = $filepath_wiup;
        }
        if ($request->hasFile('scanSK_eksplor')) {
            $scanSK_eksplor = $request->file('scanSK_eksplor');
            $filepath_eksplor = $scanSK_eksplor->store('scanSK_eksplor', 'public');
            $iup->scanSK_eksplor = $filepath_eksplor;
        }
        if ($request->hasFile('scanSK_op')) {
            $scanSK_op = $request->file('scanSK_op');
            $filepath_op = $scanSK_op->store('scanSK_op', 'public');
            $iup->scanSK_op = $filepath_op;
        }
        if ($request->hasFile('scanSK_p1')) {
            $scanSK_p1 = $request->file('scanSK_p1');
            $filepath_p1 = $scanSK_p1->store('scanSK_p1', 'public');
            $iup->scanSK_p1 = $filepath_p1;
        }
        if ($request->hasFile('scanSK_p2')) {
            $scanSK_p2 = $request->file('scanSK_p2');
            $filepath_p2 = $scanSK_p2->store('scanSK_p2', 'public');
            $iup->scanSK_p2 = $filepath_p2;
        }

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['jenisKegiatan'] = $jenisKegiatan;

        $iup->update($iupData);
        return redirect()->route('admin.eksplor.index');
    }

    public function eksplorDestroy($id){
        $IUP = IUP::find($id);

        if (!is_null($IUP->scanSK)) {
            Storage::disk('public')->delete($IUP->scanSK);
        }

        $IUP->delete();

        return redirect()->route('admin.eksplor.index');
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////op///////////////////////////////////
    ///////////////////////////////////////////////////////////////////
    public function op(){
        $iup = IUP::all();
        $op = IUP::where('tahapanKegiatan', 'IUP Tahap Operasi Produksi')->get();

        return view('admin.iup/op.index', compact(['iup','op']));
    }

    public function opCreate(){
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        return view('admin.iup/op.create', compact('tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2'));
    }

    public function opStore(Request $request){
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
        ]);

        $tanggalSK = $request->tanggalSK;
        $tanggalBerakhir = $request->tanggalBerakhir;

        $scanSK_wiup = request()->file('scanSK_wiup');
        $filepath_wiup = $scanSK_wiup ? $scanSK_wiup->store('scanSK_wiup', 'public') : null;

        $scanSK_eksplor = request()->file('scanSK_eksplor');
        $filepath_eksplor = $scanSK_eksplor ? $scanSK_eksplor->store('scanSK_eksplor', 'public') : null;

        $scanSK_op = request()->file('scanSK_op');
        $filepath_op = $scanSK_op ? $scanSK_op->store('scanSK_op', 'public') : null;

        $scanSK_p1 = request()->file('scanSK_p1');
        $filepath_p1 = $scanSK_p1 ? $scanSK_p1->store('scanSK_p1', 'public') : null;

        $scanSK_p2 = request()->file('scanSK_p2');
        $filepath_p2 = $scanSK_p2 ? $scanSK_p2->store('scanSK_p2', 'public') : null;

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

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['scanSK_wiup'] = $filepath_wiup;
        $iupData['scanSK_eksplor'] = $filepath_eksplor;
        $iupData['scanSK_op'] = $filepath_op;
        $iupData['scanSK_p1'] = $filepath_p1;
        $iupData['scanSK_p2'] = $filepath_p2;
        $iupData['jenisKegiatan'] = $jenisKegiatan;
        // dd($jenisKegiatan);

        $iup = IUP::create($iupData);
        return redirect()->route('admin.op.index');
    }
    public function opEdit($id){
        $op = IUP::find($id);
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        $IUP = IUP::find($id);
        $golonganSelectedWiup = $IUP->golongan_wiup;
        $golonganSelectedEksplor = $IUP->golongan_eksplor;
        $golonganSelectedOp = $IUP->golongan_op;
        $golonganSelectedP1 = $IUP->golongan_p1;
        $golonganSelectedP2 = $IUP->golongan_p2;

        // $data = IUP::find($id);
        return view('admin.iup/op.edit', compact(['IUP', 'op', 'tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2', 'golonganSelectedWiup', 'golonganSelectedEksplor', 'golonganSelectedOp', 'golonganSelectedP1', 'golonganSelectedP2']));
    }

    public function opUpdate(Request $request, $id){
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
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

        if ($request->hasFile('scanSK_wiup')) {
            $scanSK_wiup = $request->file('scanSK_wiup');
            $filepath_wiup = $scanSK_wiup->store('scanSK_wiup', 'public');
            $iup->scanSK_wiup = $filepath_wiup;
        }
        if ($request->hasFile('scanSK_eksplor')) {
            $scanSK_eksplor = $request->file('scanSK_eksplor');
            $filepath_eksplor = $scanSK_eksplor->store('scanSK_eksplor', 'public');
            $iup->scanSK_eksplor = $filepath_eksplor;
        }
        if ($request->hasFile('scanSK_op')) {
            $scanSK_op = $request->file('scanSK_op');
            $filepath_op = $scanSK_op->store('scanSK_op', 'public');
            $iup->scanSK_op = $filepath_op;
        }
        if ($request->hasFile('scanSK_p1')) {
            $scanSK_p1 = $request->file('scanSK_p1');
            $filepath_p1 = $scanSK_p1->store('scanSK_p1', 'public');
            $iup->scanSK_p1 = $filepath_p1;
        }
        if ($request->hasFile('scanSK_p2')) {
            $scanSK_p2 = $request->file('scanSK_p2');
            $filepath_p2 = $scanSK_p2->store('scanSK_p2', 'public');
            $iup->scanSK_p2 = $filepath_p2;
        }

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['jenisKegiatan'] = $jenisKegiatan;

        $iup->update($iupData);
        return redirect()->route('admin.op.index');
    }

    public function opDestroy($id){
        $IUP = IUP::find($id);

        if (!is_null($IUP->scanSK)) {
            Storage::disk('public')->delete($IUP->scanSK);
        }

        $IUP->delete();

        return redirect()->route('admin.op.index');
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////p1///////////////////////////////////
    ///////////////////////////////////////////////////////////////////
    public function p1(){
        $iup = IUP::all();
        $p1 = IUP::where('tahapanKegiatan', 'Perpanjangan 1 IUP Tahap Operasi Produksi')->get();

        return view('admin.iup/p1.index', compact(['iup','p1']));
    }

    public function p1Create(){
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        return view('admin.iup/p1.create', compact('tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2'));
    }

    public function p1Store(Request $request){
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
        ]);

        $tanggalSK = $request->tanggalSK;
        $tanggalBerakhir = $request->tanggalBerakhir;

        $scanSK_wiup = request()->file('scanSK_wiup');
        $filepath_wiup = $scanSK_wiup ? $scanSK_wiup->store('scanSK_wiup', 'public') : null;

        $scanSK_eksplor = request()->file('scanSK_eksplor');
        $filepath_eksplor = $scanSK_eksplor ? $scanSK_eksplor->store('scanSK_eksplor', 'public') : null;

        $scanSK_op = request()->file('scanSK_op');
        $filepath_op = $scanSK_op ? $scanSK_op->store('scanSK_op', 'public') : null;

        $scanSK_p1 = request()->file('scanSK_p1');
        $filepath_p1 = $scanSK_p1 ? $scanSK_p1->store('scanSK_p1', 'public') : null;

        $scanSK_p2 = request()->file('scanSK_p2');
        $filepath_p2 = $scanSK_p2 ? $scanSK_p2->store('scanSK_p2', 'public') : null;

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

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['scanSK_wiup'] = $filepath_wiup;
        $iupData['scanSK_eksplor'] = $filepath_eksplor;
        $iupData['scanSK_op'] = $filepath_op;
        $iupData['scanSK_p1'] = $filepath_p1;
        $iupData['scanSK_p2'] = $filepath_p2;
        $iupData['jenisKegiatan'] = $jenisKegiatan;
        // dd($jenisKegiatan);

        $iup = IUP::create($iupData);
        dd($iup);
        return redirect()->route('admin.p1.index');
    }
    public function p1Edit($id){
        $IUP = IUP::find($id);
        $p1 = IUP::find($id);
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        $IUP = IUP::find($id);
        $golonganSelectedWiup = $IUP->golongan_wiup;
        $golonganSelectedEksplor = $IUP->golongan_eksplor;
        $golonganSelectedOp = $IUP->golongan_op;
        $golonganSelectedP1 = $IUP->golongan_p1;
        $golonganSelectedP2 = $IUP->golongan_p2;

        // $data = IUP::find($id);
        return view('admin.iup/p1.edit', compact(['IUP', 'p1', 'tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2', 'golonganSelectedWiup', 'golonganSelectedEksplor', 'golonganSelectedOp', 'golonganSelectedP1', 'golonganSelectedP2']));
    }

    public function p1Update(Request $request, $id){
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
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

        if ($request->hasFile('scanSK_wiup')) {
            $scanSK_wiup = $request->file('scanSK_wiup');
            $filepath_wiup = $scanSK_wiup->store('scanSK_wiup', 'public');
            $iup->scanSK_wiup = $filepath_wiup;
        }
        if ($request->hasFile('scanSK_eksplor')) {
            $scanSK_eksplor = $request->file('scanSK_eksplor');
            $filepath_eksplor = $scanSK_eksplor->store('scanSK_eksplor', 'public');
            $iup->scanSK_eksplor = $filepath_eksplor;
        }
        if ($request->hasFile('scanSK_op')) {
            $scanSK_op = $request->file('scanSK_op');
            $filepath_op = $scanSK_op->store('scanSK_op', 'public');
            $iup->scanSK_op = $filepath_op;
        }
        if ($request->hasFile('scanSK_p1')) {
            $scanSK_p1 = $request->file('scanSK_p1');
            $filepath_p1 = $scanSK_p1->store('scanSK_p1', 'public');
            $iup->scanSK_p1 = $filepath_p1;
        }
        if ($request->hasFile('scanSK_p2')) {
            $scanSK_p2 = $request->file('scanSK_p2');
            $filepath_p2 = $scanSK_p2->store('scanSK_p2', 'public');
            $iup->scanSK_p2 = $filepath_p2;
        }

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['jenisKegiatan'] = $jenisKegiatan;

        $iup->update($iupData);
        dd($iup);
        return redirect()->route('admin.p1.index');
    }

    public function p1Destroy($id){
        $IUP = IUP::find($id);

        if (!is_null($IUP->scanSK)) {
            Storage::disk('public')->delete($IUP->scanSK);
        }

        $IUP->delete();

        return redirect()->route('admin.p1.index');
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////p2///////////////////////////////////
    ///////////////////////////////////////////////////////////////////
    public function p2(){
        $iup = IUP::all();
        $p2 = IUP::where('tahapanKegiatan', 'Perpanjangan 2 IUP Tahap Operasi Produksi')->get();

        return view('admin.iup/p2.index', compact(['iup','p2']));
    }

    public function p2Create(){
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        return view('admin.iup/p2.create', compact('tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2'));
    }

    public function p2Store(Request $request){
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
        ]);

        $tanggalSK = $request->tanggalSK;
        $tanggalBerakhir = $request->tanggalBerakhir;

        $scanSK_wiup = request()->file('scanSK_wiup');
        $filepath_wiup = $scanSK_wiup ? $scanSK_wiup->store('scanSK_wiup', 'public') : null;

        $scanSK_eksplor = request()->file('scanSK_eksplor');
        $filepath_eksplor = $scanSK_eksplor ? $scanSK_eksplor->store('scanSK_eksplor', 'public') : null;

        $scanSK_op = request()->file('scanSK_op');
        $filepath_op = $scanSK_op ? $scanSK_op->store('scanSK_op', 'public') : null;

        $scanSK_p1 = request()->file('scanSK_p1');
        $filepath_p1 = $scanSK_p1 ? $scanSK_p1->store('scanSK_p1', 'public') : null;

        $scanSK_p2 = request()->file('scanSK_p2');
        $filepath_p2 = $scanSK_p2 ? $scanSK_p2->store('scanSK_p2', 'public') : null;

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

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['scanSK_wiup'] = $filepath_wiup;
        $iupData['scanSK_eksplor'] = $filepath_eksplor;
        $iupData['scanSK_op'] = $filepath_op;
        $iupData['scanSK_p1'] = $filepath_p1;
        $iupData['scanSK_p2'] = $filepath_p2;
        $iupData['jenisKegiatan'] = $jenisKegiatan;
        // dd($jenisKegiatan);

        $iup = IUP::create($iupData);
        dd($iup);
        return redirect()->route('admin.p2.index');
    }
    public function p2Edit($id){
        $IUP = IUP::find($id);
        $p2 = IUP::find($id);
        $tahapanKegiatan = [
            'WIUP' => 'WIUP',
            'IUP Tahap Eksplorasi' => 'IUP Tahap Eksplorasi',
            'IUP Tahap Operasi Produksi' => 'IUP Tahap Operasi Produksi',
            'Perpanjangan 1 IUP Tahap Operasi Produksi' => 'Perpanjangan 1 IUP Tahap Operasi Produksi',
            'Perpanjangan 2 IUP Tahap Operasi Produksi' => 'Perpanjangan 2 IUP Tahap Operasi Produksi',
        ];

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        $IUP = IUP::find($id);
        $golonganSelectedWiup = $IUP->golongan_wiup;
        $golonganSelectedEksplor = $IUP->golongan_eksplor;
        $golonganSelectedOp = $IUP->golongan_op;
        $golonganSelectedP1 = $IUP->golongan_p1;
        $golonganSelectedP2 = $IUP->golongan_p2;

        // $data = IUP::find($id);
        return view('admin.iup/p2.edit', compact(['IUP', 'p2', 'tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2', 'golonganSelectedWiup', 'golonganSelectedEksplor', 'golonganSelectedOp', 'golonganSelectedP1', 'golonganSelectedP2']));
    }

    public function p2Update(Request $request, $id){
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
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

        if ($request->hasFile('scanSK_wiup')) {
            $scanSK_wiup = $request->file('scanSK_wiup');
            $filepath_wiup = $scanSK_wiup->store('scanSK_wiup', 'public');
            $iup->scanSK_wiup = $filepath_wiup;
        }
        if ($request->hasFile('scanSK_eksplor')) {
            $scanSK_eksplor = $request->file('scanSK_eksplor');
            $filepath_eksplor = $scanSK_eksplor->store('scanSK_eksplor', 'public');
            $iup->scanSK_eksplor = $filepath_eksplor;
        }
        if ($request->hasFile('scanSK_op')) {
            $scanSK_op = $request->file('scanSK_op');
            $filepath_op = $scanSK_op->store('scanSK_op', 'public');
            $iup->scanSK_op = $filepath_op;
        }
        if ($request->hasFile('scanSK_p1')) {
            $scanSK_p1 = $request->file('scanSK_p1');
            $filepath_p1 = $scanSK_p1->store('scanSK_p1', 'public');
            $iup->scanSK_p1 = $filepath_p1;
        }
        if ($request->hasFile('scanSK_p2')) {
            $scanSK_p2 = $request->file('scanSK_p2');
            $filepath_p2 = $scanSK_p2->store('scanSK_p2', 'public');
            $iup->scanSK_p2 = $filepath_p2;
        }

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['jenisKegiatan'] = $jenisKegiatan;

        $iup->update($iupData);
        return redirect()->route('admin.p2.index');
    }

    public function p2Destroy($id){
        $IUP = IUP::find($id);

        if (!is_null($IUP->scanSK)) {
            Storage::disk('public')->delete($IUP->scanSK);
        }

        $IUP->delete();

        return redirect()->route('admin.p2.index');
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

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        return view('admin.iup.create', compact('tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2'));
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
        ]);

        $tanggalSK = $request->tanggalSK;
        $tanggalBerakhir = $request->tanggalBerakhir;

        $scanSK_wiup = request()->file('scanSK_wiup');
        $filepath_wiup = $scanSK_wiup ? $scanSK_wiup->store('scanSK_wiup', 'public') : null;

        $scanSK_eksplor = request()->file('scanSK_eksplor');
        $filepath_eksplor = $scanSK_eksplor ? $scanSK_eksplor->store('scanSK_eksplor', 'public') : null;

        $scanSK_op = request()->file('scanSK_op');
        $filepath_op = $scanSK_op ? $scanSK_op->store('scanSK_op', 'public') : null;

        $scanSK_p1 = request()->file('scanSK_p1');
        $filepath_p1 = $scanSK_p1 ? $scanSK_p1->store('scanSK_p1', 'public') : null;

        $scanSK_p2 = request()->file('scanSK_p2');
        $filepath_p2 = $scanSK_p2 ? $scanSK_p2->store('scanSK_p2', 'public') : null;

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

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
        $iupData['statusIzin'] = $statusIzin;
        $iupData['scanSK_wiup'] = $filepath_wiup;
        $iupData['scanSK_eksplor'] = $filepath_eksplor;
        $iupData['scanSK_op'] = $filepath_op;
        $iupData['scanSK_p1'] = $filepath_p1;
        $iupData['scanSK_p2'] = $filepath_p2;
        $iupData['jenisKegiatan'] = $jenisKegiatan;
        // dd($jenisKegiatan);

        $iup = IUP::create($iupData);

        // dd($tanggalMulai, $tanggalBerakhir, now());
        dd($iup);
        return redirect()->route('admin.iup.index');
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

        $golongan_wiup = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_eksplor = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_op = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p1 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golongan_p2 = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $kabupaten = Kabupaten::whereNotNull('kabupaten')->pluck('kabupaten', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        $IUP = IUP::find($id);
        $golonganSelectedWiup = $IUP->golongan_wiup;
        $golonganSelectedEksplor = $IUP->golongan_eksplor;
        $golonganSelectedOp = $IUP->golongan_op;
        $golonganSelectedP1 = $IUP->golongan_p1;
        $golonganSelectedP2 = $IUP->golongan_p2;
        // $komoditasSelectedWiup = $IUP->komoditas_wiup;

        // $data = IUP::find($id);
        return view('admin.iup.edit', compact(['IUP', 'tahapanKegiatan', 'perusahaanUser', 'kabupaten', 'komoditas', 'golongan_wiup', 'golongan_eksplor', 'golongan_op', 'golongan_p1', 'golongan_p2', 'golonganSelectedWiup', 'golonganSelectedEksplor', 'golonganSelectedOp', 'golonganSelectedP1', 'golonganSelectedP2']));
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
            'golongan_wiup' => 'nullable',
            'golongan_eksplor' => 'nullable',
            'golongan_op' => 'nullable',
            'golongan_p1' => 'nullable',
            'golongan_p2' => 'nullable',
            'komoditas_wiup' => 'nullable',
            'komoditas_eksplor' => 'nullable',
            'komoditas_op' => 'nullable',
            'komoditas_p1' => 'nullable',
            'komoditas_p2' => 'nullable',
            'lokasiIzin' => 'required',
            'scanSK_wiup' => 'nullable|file|mimes:pdf',
            'scanSK_eksplor' => 'nullable|file|mimes:pdf',
            'scanSK_op' => 'nullable|file|mimes:pdf',
            'scanSK_p1' => 'nullable|file|mimes:pdf',
            'scanSK_p2' => 'nullable|file|mimes:pdf',
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

        if ($request->hasFile('scanSK_wiup')) {
            $scanSK_wiup = $request->file('scanSK_wiup');
            $filepath_wiup = $scanSK_wiup->store('scanSK_wiup', 'public');
            $iup->scanSK_wiup = $filepath_wiup;
        }
        if ($request->hasFile('scanSK_eksplor')) {
            $scanSK_eksplor = $request->file('scanSK_eksplor');
            $filepath_eksplor = $scanSK_eksplor->store('scanSK_eksplor', 'public');
            $iup->scanSK_eksplor = $filepath_eksplor;
        }
        if ($request->hasFile('scanSK_op')) {
            $scanSK_op = $request->file('scanSK_op');
            $filepath_op = $scanSK_op->store('scanSK_op', 'public');
            $iup->scanSK_op = $filepath_op;
        }
        if ($request->hasFile('scanSK_p1')) {
            $scanSK_p1 = $request->file('scanSK_p1');
            $filepath_p1 = $scanSK_p1->store('scanSK_p1', 'public');
            $iup->scanSK_p1 = $filepath_p1;
        }
        if ($request->hasFile('scanSK_p2')) {
            $scanSK_p2 = $request->file('scanSK_p2');
            $filepath_p2 = $scanSK_p2->store('scanSK_p2', 'public');
            $iup->scanSK_p2 = $filepath_p2;
        }

        // $statusIzin = $tahapanKegiatan === 'WIUP' && $tanggalSK && now()->gte($tanggalSK) ? 'Aktif' : 'Tidak Aktif';

        // if ($tahapanKegiatan !== 'WIUP') {
        //     $statusIzin = $tanggalSK && $tanggalBerakhir ? (now()->gte($tanggalSK) && now()->lte($tanggalBerakhir) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
        // }

        $iupData = $request->except('fromModal', 'scanSK_wiup', 'scanSK_eksplor', 'scanSK_op', 'scanSK_p1', 'scanSK_p2');
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

        // $iupData['scanSK_wiup'] = $filepath_wiup;
        // $iupData['scanSK_eksplor'] = $filepath_eksplor;
        // $iupData['scanSK_op'] = $filepath_op;
        // $iupData['scanSK_p1'] = $filepath_p1;
        // $iupData['scanSK_p2'] = $filepath_p2;

        $iup->update($iupData);

        // $iup->save();
        // $iup->statusIzin;

        // dd($iup);
        return redirect()->route('admin.iup.index')->with('status', 'Data berhasil diperbarui.');
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

        return redirect()->route('admin.iup.index');
    }
}
