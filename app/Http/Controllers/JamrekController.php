<?php

namespace App\Http\Controllers;

use App\Models\User;
use Storage;
use App\Models\Jamrek;
use Illuminate\Http\Request;

class JamrekController extends Controller
{
    public function index()
    {
        $jamrek = Jamrek::all();
        return view('jamrek.index', compact(['jamrek']));
    }

    public function create(){
        $bentukPenempatan = [
            'Deposito' => 'Deposito',
            'Bank Garansi' => 'Bank Garansi',
        ];
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        return view('jamrek.create', compact(['perusahaanUser', 'bentukPenempatan']));

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

        if($bentukPenempatan == 'Deposito'){
            $status = 'Aktif';
        } elseif ($bentukPenempatan = 'Bank Garansi'){
            $tanggalPenempatan = $request->tanggalPenempatan;
            $jatuhTempo = $request->jatuhTempo;
            $status = $tanggalPenempatan && $jatuhTempo ? (now()->gte($tanggalPenempatan) && now()->lte($jatuhTempo) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
        }

        $filePenempatan = request()->file('filePenempatan');
        $filepathPenempatan = $filePenempatan ? $filePenempatan->store('filePenempatan', 'public') : null;

        $fileReklamasi = request()->file('fileReklamasi');
        $filepathReklamasi = $fileReklamasi ? $fileReklamasi->store('fileReklamasi', 'public') : null;

        $jamrekData = $request->all();
        $jamrekData['status'] = $status;
        $jamrekData['filePenempatan'] = $filepathPenempatan;
        $jamrekData['fileReklamasi'] = $filepathReklamasi;

        $jamrek = Jamrek::create($jamrekData);
        dd($jamrekData);

        return redirect()->route('jamrek.index');
    }

    public function edit($id){
        $jamrek = Jamrek::find($id);
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $bentukPenempatan = [
            'Deposito' => 'Deposito',
            'Bank Garansi' => 'Bank Garansi',
        ];
        $bentukPenempatanSelected = $jamrek->bentukPenempatan;
        return view('jamrek.edit', compact(['jamrek', 'perusahaanUser', 'bentukPenempatan', 'bentukPenempatanSelected']));
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

        $bentukPenempatan = $jamrek->bentukPenempatan;

        if($bentukPenempatan == 'Deposito'){
            $status = 'Aktif';
        } elseif ($bentukPenempatan = 'Bank Garansi'){
            $tanggalPenempatan = $request->tanggalPenempatan;
            $jatuhTempo = $request->jatuhTempo;
            $status = $tanggalPenempatan && $jatuhTempo ? (now()->gte($tanggalPenempatan) && now()->lte($jatuhTempo) ? 'Aktif' : 'Tidak Aktif') : 'Tidak Aktif';
        }

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
        $jamrekData = $request->all();

        $jamrekData['status'] = $status;
        $jamrek->update($jamrekData);

        // dd($jamrek);

        return redirect()->route('jamrek.index');
    }

    public function destroy($id){
        $jamrek = Jamrek::find($id);
        if (!is_null($jamrek->filePenempatan)) {
            Storage::disk('public')->delete($jamrek->filePenempatan);
        } else if (!is_null($jamrek->fileReklamasi)) {
            Storage::disk('public')->delete($jamrek->fileReklamasi);
        }

        $jamrek->delete();

        return redirect()->route('jamrek.index');
    }
}
