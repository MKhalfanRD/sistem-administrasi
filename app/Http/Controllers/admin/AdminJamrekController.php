<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jamrek;
use App\Models\User;
use Storage;
use Illuminate\Http\Request;

class AdminJamrekController extends Controller
{
    public function index()
    {
        $jamrek = Jamrek::all();
        return view('admin.jamrek.index', compact(['jamrek']));
    }

    public function create(){
        $bentukPenempatan = [
            'Deposito' => 'Deposito',
            'Bank Garansi' => 'Bank Garansi',
        ];
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        return view('admin.jamrek.create', compact(['perusahaanUser', 'bentukPenempatan']));

    }

    public function store(Request $request){
        session()->flashInput($request->input());
        $request->validate([
            'namaPerusahaan' => 'required',
            'besaranDitetapkan' => 'required',
            'tanggal' => 'required',
            'filePenempatan' => 'nullable|file|mimes:pdf',
            'besaranDitempatkan' => 'required',
            'tanggalPenempatan' => 'required',
            'jatuhTempo' => 'required',
            'namaBank' => 'required',
            'bentukPenempatan' => 'required',
            'noSeri' => 'required',
            'noRekening' => 'required',
            'fileReklamasi' => 'nullable|file|mimes:pdf',
        ]);

        $bentukPenempatan = $request->bentukPenempatan;

        if($bentukPenempatan === 'Deposito'){
            $status = 'Aktif';
        } elseif ($bentukPenempatan === 'Bank Garansi'){
            $tanggalPenempatan = $request->tanggalPenempatan;
            $jatuhTempo = $request->jatuhTempo;
            $status = $tanggalPenempatan && $jatuhTempo ? (now()->gte($tanggalPenempatan) && now()->lte($jatuhTempo) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
        }

        $filePenempatan = request()->file('filePenempatan');
        $filepathPenempatan = $filePenempatan ? $filePenempatan->store('filePenempatan', 'public') : null;

        $fileReklamasi = request()->file('fileReklamasi');
        $filepathReklamasi = $fileReklamasi ? $fileReklamasi->store('fileReklamasi', 'public') : null;

        $jamrekData = $request->except('fileReklamasi', 'filePenempatan');
        $jamrekData['status'] = $status;
        $jamrekData['filePenempatan'] = $filepathPenempatan;
        $jamrekData['fileReklamasi'] = $filepathReklamasi;

        $user = User::where('namaPerusahaan', $request->namaPerusahaan)->first();
        $jamrekData['user_id'] = $user->id;

        $jamrek = Jamrek::create($jamrekData);
        dd($jamrekData);

        return redirect()->route('admin.jamrek.index');
    }

    public function edit($id){
        $jamrek = Jamrek::find($id);
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $bentukPenempatan = [
            'Deposito' => 'Deposito',
            'Bank Garansi' => 'Bank Garansi',
        ];
        $bentukPenempatanSelected = $jamrek->bentukPenempatan;
        return view('admin.jamrek.edit', compact(['jamrek', 'perusahaanUser', 'bentukPenempatan', 'bentukPenempatanSelected']));
    }

    public function update(Request $request, $id){
        // dd($request->all);
        $request->validate([
            'namaPerusahaan' => 'required',
            'besaranDitetapkan' => 'required',
            'tanggal' => 'required',
            'filePenempatan' => 'nullable|file|mimes:pdf',
            'besaranDitempatkan' => 'required',
            'tanggalPenempatan' => 'required',
            'jatuhTempo' => 'required',
            'namaBank' => 'required',
            'bentukPenempatan' => 'required',
            'noSeri' => 'required',
            'noRekening' => 'required',
            'fileReklamasi' => 'nullable|file|mimes:pdf',
        ]);

        $jamrek = Jamrek::find($id);

        if($request->hasFile('filePenempatan')){
            if($jamrek->filePenempatan){
                Storage::disk('public')->delete($jamrek->filePenempatan);
            }
            $filePenempatan = request()->file('filePenempatan');
            $filepathPenempatan = $filePenempatan->store('filePenempatan', 'public');
        }
        else {
            $filepathPenempatan = $jamrek->filePenempatan;
        }

        if ($request->hasFile('fileReklamasi')){
            if($jamrek->fileReklamasi){
                Storage::disk('public')->delete($jamrek->fileReklamasi);
            }
            $fileReklamasi = request()->file('fileReklamasi');
            $filepathReklamasi = $fileReklamasi->store('fileReklamasi', 'public');
        }
        else {
            $filepathReklamasi = $jamrek->fileReklamasi;
        }

        $bentukPenempatan = $request->bentukPenempatan;

        $status = $bentukPenempatan === 'Deposito'? 'Aktif' : 'Tidak Aktif';

        if ($bentukPenempatan === 'Bank Garansi'){
            $tanggalPenempatan = $request->tanggalPenempatan;
            $jatuhTempo = $request->jatuhTempo;
            $status = $tanggalPenempatan && $jatuhTempo ? (now()->gte($tanggalPenempatan) && now()->lte($jatuhTempo) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
        }

        $jamrekData = $request->except('fileReklamasi', 'filePenempatan');
        $jamrekData['status'] = $status;
        $jamrekData['filePenempatan'] = $filepathPenempatan;
        $jamrekData['fileReklamasi'] = $filepathReklamasi;

        $user = User::where('namaPerusahaan', $request->namaPerusahaan)->first();

        if ($user) {
            $jamrekData['user_id'] = $user->id;
        }

        $jamrek = $jamrek->update($jamrekData);

        // dd($jamrek);

        return redirect()->route('admin.jamrek.index');
    }

    public function destroy($id){
        $jamrek = Jamrek::find($id);
        if (!is_null($jamrek->filePenempatan)) {
            Storage::disk('public')->delete($jamrek->filePenempatan);
        } else if (!is_null($jamrek->fileReklamasi)) {
            Storage::disk('public')->delete($jamrek->fileReklamasi);
        }

        $jamrek->delete();

        return redirect()->route('admin.jamrek.index');
    }
}
