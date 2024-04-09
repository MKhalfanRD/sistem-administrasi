<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jampas;
use App\Models\User;
use Storage;
use Illuminate\Http\Request;

class AdminJampasController extends Controller
{
    public function index()
    {
        $jampas = Jampas::all();
        return view('admin.jampas.index', compact(['jampas']));
    }

    public function create(){
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        return view('admin.jampas.create', compact(['perusahaanUser']));

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

        $jampasData = $request->except('filePasca', 'filePenempatan');
        $jampasData['filePenempatan'] = $filepathPenempatan;
        $jampasData['filePasca'] = $filepathPasca;

        $user = User::where('namaPerusahaan', $request->namaPerusahaan)->first();
        $jampasData['user_id'] = $user->id;

        $jampas = Jampas::create($jampasData);
        // dd($jampasData);

        return redirect()->route('admin.jampas.index');
    }

    public function edit($id){
        $jampas = Jampas::find($id);
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');

        return view('admin.jampas.edit', compact(['jampas', 'perusahaanUser']));
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

        if ($request->hasFile('filePasca')){
            if($jampas->filePasca){
                Storage::disk('public')->delete($jampas->filePasca);
            }
            $filePasca = request()->file('filePasca');
            $filepathPasca = $filePasca->store('filePasca', 'public');
        }
        else {
            $filepathPasca = $jampas->filePasca;
        }

        $jampasData = $request->except('filePasca', 'filePenempatan');
        $jampasData['filePasca'] = $filepathPasca;
        $jampasData['filePenempatan'] = $filepathPenempatan;

        $user = User::where('namaPerusahaan', $request->namaPerusahaan)->first();

        if ($user) {
            $jampasData['user_id'] = $user->id;
        }

        $jampas->update($jampasData);

        dd($jampasData);

        return redirect()->route('admin.jampas.index');
    }

    public function destroy($id){
        $jampas = Jampas::find($id);
        if (!is_null($jampas->filePenempatan)) {
            Storage::disk('public')->delete($jampas->filePenempatan);
        } else if (!is_null($jampas->fileReklamasi)) {
            Storage::disk('public')->delete($jampas->fileReklamasi);
        }
        $jampas->delete();

        return redirect()->route('admin.jampas.index');
    }
}
