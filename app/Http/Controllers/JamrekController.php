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
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        return view('jamrek.create', compact(['perusahaanUser']));

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

        $filePenempatan = request()->file('filePenempatan');
        $filepathPenempatan = $filePenempatan ? $filePenempatan->store('filePenempatan', 'public') : null;

        $fileReklamasi = request()->file('fileReklamasi');
        $filepathReklamasi = $fileReklamasi ? $fileReklamasi->store('fileReklamasi', 'public') : null;

        $jamrek= Jamrek::create([
            'namaPerusahaan' => $request->namaPerusahaan,
            'besaranDitetapkan' => $request->besaranDitetapkan,
            'tanggal' => $request->tanggal,
            'filePenempatan' => $filepathPenempatan,
            'besaranDitempatkan' => $request->besaranDitempatkan,
            'tanggalPenempatan' => $request->tanggalPenempatan,
            'jatuhTempo' => $request->jatuhTempo,
            'namaBank' => $request->namaBank,
            'bentukPenempatan' => $request->bentukPenempatan,
            'noSeri' => $request->noSeri,
            'noRekening' => $request->noRekening,
            'fileReklamasi' => $filepathReklamasi,
        ]);

        return redirect()->route('jamrek.index');
    }

    public function edit($id){
        $jamrek = Jamrek::find($id);
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');

        return view('jamrek.edit', compact(['jamrek', 'perusahaanUser']));
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

        $jamrek->update([
            'namaPerusahaan' => $request->namaPerusahaan,
            'besaranDitetapkan' => $request->besaranDitetapkan,
            'tanggal' => $request->tanggal,
            'filePenempatan' => $filepathPenempatan,
            'besaranDitempatkan' => $request->besaranDitempatkan,
            'tanggalPenempatan' => $request->tanggalPenempatan,
            'jatuhTempo' => $request->jatuhTempo,
            'namaBank' => $request->namaBank,
            'bentukPenempatan' => $request->bentukPenempatan,
            'noSeri' => $request->noSeri,
            'noRekening' => $request->noRekening,
            'fileReklamasi' => $filepathReklamasi,
        ]);

        return redirect()->route('jamrek.index');
    }

    public function destroy($id){
        $jamrek = Jamrek::find($id);
        Storage::disk('public')->delete($jamrek->filePenempatan);
        Storage::disk('public')->delete($jamrek->fileReklamasi);
        $jamrek->delete();

        return redirect()->route('jamrek.index');
    }
}
