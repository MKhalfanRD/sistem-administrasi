<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use App\Models\Produksi;
use App\Models\User;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    public function index(){
        $produksi = Produksi::all();

        return view('produksi.index', compact(['produksi']));
    }

    public function create(){
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        return view('produksi.create', compact(['perusahaanUser', 'komoditas']));
    }

    public function store(Request $request){
        $request->validate([
            'namaPerusahaan' => 'required',
            'komoditas' => 'required',
            'volumeProduksi' => 'nullable',
            'tonaseProduksi' => 'nullable',
            'date' => 'required',
        ]);

        $produksiData = $request->all();
        $produksi = Produksi::create($produksiData);

        return redirect()->route('produksi.index');
    }

    public function edit($id){
        $produksi = Produksi::find($id);
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $komoditas = Komoditas::whereNotNull('komoditas')->pluck('komoditas', 'id');

        return view('produksi.edit', compact(['produksi', 'perusahaanUser', 'komoditas']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'namaPerusahaan' => 'required',
            'komoditas' => 'required',
            'volumeProduksi' => 'nullable',
            'tonaseProduksi' => 'nullable',
            'date' => 'required',
        ]);

        $produksi = Produksi::find($id);
        $produksiData = $request->all();
        $produksi->update($produksiData);

        return redirect()->route('produksi.index');
    }

    public function destroy($id){
        $produksi = Produksi::find($id);

        $produksi->delete();

        return redirect()->route('produksi.index');
    }
}
