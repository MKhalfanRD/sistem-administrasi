<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Komoditas;
use App\Models\Sumberdaya;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSumberdayaController extends Controller
{
    public function index(){
        $sumberdaya = Sumberdaya::all();
        return view('admin.sumberdaya.index', compact(['sumberdaya']));
    }

    public function create(){
        $jenisSdm = [
            'Tereka' => 'Tereka',
            'Tertunjuk' => 'Tertunjuk',
            'Terukur' => 'Terukur',
        ];
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');
        return view('admin.sumberdaya.create', compact(['jenisSdm', 'perusahaanUser', 'komoditas']));
    }

    public function store(Request $request){
        session()->flashInput($request->input());
        $request->validate([
            'namaPerusahaan' => 'required',
            'komoditas' => 'required',
            'jenisSdm' => 'nullable',
            'volumeTereka' => 'nullable',
            'volumeTertunjuk' => 'nullable',
            'volumeTerukur' => 'nullable',
            'tonaseTereka' => 'nullable',
            'tonaseTertunjuk' => 'nullable',
            'tonaseTerukur' => 'nullable',
            'luas' => 'required',
            'cp' => 'required',
        ]);

        $jenisSdm = $request->jenisSdm;

        switch ($jenisSdm) {
            case 'Tereka':
                $volume = $request->volumeTereka;
                $tonase = $request->tonaseTereka;
                break;
            case 'Tertunjuk':
                $volume = $request->volumeTertunjuk;
                $tonase = $request->tonaseTereka;
                break;
            case 'Terukur':
                $volume = $request->volumeTerukur;
                $tonase = $request->tonaseTerukur;
                break;
            default:
                $volume = null;
                $tonase = null;
                break;
        }

        $sdmData = $request->all();

        $user = User::where('namaPerusahaan', $request->namaPerusahaan)->first();
        $sdmData['user_id'] = $user->id;

        $sumberdaya = Sumberdaya::create($sdmData);
        return redirect()->route('admin.sumberdaya.index');
    }

    public function edit($id){
        $jenisSdm = [
            'Tereka' => 'Tereka',
            'Tertunjuk' => 'Tertunjuk',
            'Terukur' => 'Terukur',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');
        $sumberdaya = Sumberdaya::find($id);
        $jenisSdmSelected = $sumberdaya->jenisSdm;

        return view('admin.sumberdaya.edit', compact(['jenisSdm', 'perusahaanUser', 'komoditas' ,'sumberdaya', 'jenisSdmSelected']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'namaPerusahaan' => 'required',
            'komoditas' => 'required',
            'jenisSdm' => 'nullable',
            'volumeTereka' => 'nullable',
            'volumeTertunjuk' => 'nullable',
            'volumeTerukur' => 'nullable',
            'tonaseTereka' => 'nullable',
            'tonaseTertunjuk' => 'nullable',
            'tonaseTerukur' => 'nullable',
            'luas' => 'required',
            'cp' => 'required',
        ]);

        $sumberdaya = Sumberdaya::find($id);

        $jenisSdm = $request->jenisSdm;

        switch ($jenisSdm) {
            case 'Tereka':
                $volume = $request->volumeTereka;
                $tonase = $request->tonaseTereka;
                break;
            case 'Tertunjuk':
                $volume = $request->volumeTertunjuk;
                $tonase = $request->tonaseTereka;
                break;
            case 'Terukur':
                $volume = $request->volumeTerukur;
                $tonase = $request->tonaseTerukur;
                break;
            default:
                $volume = null;
                $tonase = null;
                break;
        }

        $sdmData = $request->all();

        $user = User::where('namaPerusahaan', $request->namaPerusahaan)->first();

        if ($user) {
            $sdmData['user_id'] = $user->id;
        }

        $sumberdaya->update($sdmData);

        return redirect()->route('admin.sumberdaya.index');
    }

    public function destroy($id){
        $sumberdaya = Sumberdaya::find($id);

        $sumberdaya->delete();

        return redirect()->route('admin.sumberdaya.index');
    }
}
