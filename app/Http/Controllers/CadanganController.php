<?php

namespace App\Http\Controllers;

use App\Models\Cadangan;
use App\Models\User;
use Illuminate\Http\Request;

class CadanganController extends Controller
{
    public function index(){
        $cadangan = Cadangan::all();
        return view('cadangan.index', compact(['cadangan']));
    }

    public function create(){
        $jenisCadangan = [
            'Terkira' => 'Terkira',
            'Terbukti' => 'Terbukti',
        ];

        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');

        return view('cadangan.create', compact(['jenisCadangan', 'perusahaanUser']));
    }

    public function store(Request $request){
        session()->flashInput($request->input());
        $request->validate([
            'namaPerusahaan' => 'required',
            'volumeTerkira' => 'nullable',
            'volumeTerbukti' => 'nullable',
            'tonaseTerkira' => 'nullable',
            'tonaseTerbukti' => 'nullable',
            'luas' => 'required',
            'cp' => 'required',
        ]);

        $jenisCadangan = $request->jenisCadangan;

        switch($jenisCadangan){
            case 'Terkira' :
                $volume = $request->volumeTerkira;
                $tonase = $request->tonaseTerkira;
                break;
            case 'Terbukti' :
                $volume = $request->volumeTerbukti;
                $tonase = $request->tonaseTerbukti;
                break;
            default:
                $volume = null;
                $tonase = null;
                break;
        }

        $cadanganData = $request->all();
        $cadangan = Cadangan::create($cadanganData);
        dd($cadangan);
        return redirect()->route('cadangan.index');
    }

    public function edit($id){
        $jenisCadangan = [
            'Terkira' => 'Terkira',
            'Terbukti' => 'Terbukti',
        ];
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $cadangan = Cadangan::find($id);
        $cadanganSelected = $cadangan->jenisCadangan;

        return view('cadangan.edit', compact(['jenisCadangan', 'perusahaanUser', 'cadangan', 'cadanganSelected']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'namaPerusahaan' => 'required',
            'volumeTerkira' => 'nullable',
            'volumeTerbukti' => 'nullable',
            'tonaseTerkira' => 'nullable',
            'tonaseTerbukti' => 'nullable',
            'luas' => 'required',
            'cp' => 'required',
        ]);

        $cadangan = Cadangan::find($id);

        $jenisCadangan = $request->jenisCadangan;

        switch($jenisCadangan){
            case 'Terkira' :
                $volume = $request->volumeTerkira;
                $tonase = $request->tonaseTerkira;
                break;
            case 'Terbukti' :
                $volume = $request->volumeTerbukti;
                $tonase = $request->tonaseTerbukti;
                break;
            default :
                $volume = null;
                $tonase = null;
                break;
        }


        $cadanganData = $request->all();
        $cadangan = Cadangan::update($cadanganData);

        return redirect()->route('cadangan.index');
    }

    public function destroy($id){
        $cadangan = Cadangan::find($id);
        $cadangan->delete();

        return redirect()->route('cadangan.index');
    }
}
