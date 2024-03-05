<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use Illuminate\Http\Request;

class KomoditasController extends Controller
{
    public function index(){
        $komoditas = Komoditas::all();
        return view('komoditas.index', compact(['komoditas']));
    }

    public function create(){
        $golongan = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        return view('komoditas.create', compact(['golongan']));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'golongan' => 'required',
            'inputs' => 'required|array',
            'inputs.*.komoditas' => 'required',
        ]);

        $komoditas = implode(', ', array_map(function($input){
            return trim($input['komoditas']);
        }, $validateData['inputs']));

        Komoditas::create([
            'golongan' => $validateData['golongan'],
            'komoditas' => $komoditas,
        ]);

        // dd($komoditas);
        return redirect()->route('komoditas.index')
        ->with('success', 'Data berhasil disimpan')
        ->with('delay', 1500);
    }

    public function edit($id){
        $komoditas = Komoditas::find($id);
        $golongan = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golonganSelected = $komoditas->golongan;
        return view('komoditas.edit', compact(['komoditas', 'golongan', 'golonganSelected']));
    }
}
