<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Storage;
use App\Models\Jampas;
use App\Models\User;
use Illuminate\Http\Request;

class UserJampasController extends Controller
{
    public function index()
    {
        $jampas = Jampas::all();
        return view('jampas.index', compact(['jampas']));
    }

    public function create(){
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        return view('jampas.create', compact(['perusahaanUser']));

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
            'filePasca' => 'nullable|file|mimes:pdf',
        ]);

        $filePenempatan = request()->file('filePenempatan');
        $filepathPenempatan = $filePenempatan ? $filePenempatan->store('filePenempatan', 'public') : null;

        $filePasca = request()->file('filePasca');
        $filepathPasca = $filePasca ? $filePasca->store('filePasca', 'public') : null;

        $jampasData = $request->all();
        $jampasData['filePenempatan'] = $filepathPenempatan;
        $jampasData['filePasca'] = $filepathPasca;

        $jampas = Jampas::create($jampasData);
        // dd($jampasData);

        return redirect()->route('jampas.index');
    }

    public function edit($id){
        $jampas = Jampas::find($id);
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');

        return view('jampas.edit', compact(['jampas', 'perusahaanUser']));
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
            'filePasca' => 'nullable|file|mimes:pdf',
        ]);

        $jampas = Jampas::find($id);

        if($request->hasFile('filePenempatan')){
            if($jampas->filePenempatan){
                Storage::disk('public')->delete($jampas->filePenempatan);
            }
            $filePenempatan = request()->file('filePenempatan');
            $filepathPenempatan = $filePenempatan->store('filePenempatan', 'public');
        }
        else {
            $filepathPenempatan = $jampas->filePenempatan;
        }

        if ($request->hasFile('fileReklamasi')){
            if($jampas->filePasca){
                Storage::disk('public')->delete($jampas->filePasca);
            }
            $filePasca = request()->file('filePasca');
            $filepathPasca = $filePasca->store('filePasca', 'public');
        }
        else {
            $filepathPasca = $jampas->filePasca;
        }

        $jampas->update([
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
            'filePasca' => $filepathPasca,
        ]);

        // dd($jampas);

        return redirect()->route('jampas.index');
    }

    public function destroy($id){
        $jampas = Jampas::find($id);
        Storage::disk('public')->delete($jampas->filePenempatan);
        Storage::disk('public')->delete($jampas->filePasca);
        $jampas->delete();

        return redirect()->route('jampas.index');
    }
}
