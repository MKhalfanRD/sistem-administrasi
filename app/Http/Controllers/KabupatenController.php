<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function index(){
        $kabupaten = Kabupaten::all();
        return view('kabupaten.index', compact(['kabupaten']));
    }

    public function create(){
        return view('kabupaten.create');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'inputs' => 'required|array',
            'inputs.*.kabupaten' => 'required',
        ]);

        foreach($validateData['inputs'] as $input){
            Kabupaten::create([
                'kabupaten' => $input['kabupaten'],
            ]);
        }

        return redirect()->route('kabupaten.index')
        ->with('success', 'Data berhasil disimpan')
        ->with('delay', 1500);
    }

    public function edit($id){
        $kabupaten = Kabupaten::findOrFail($id);

        return view('kabupaten.edit', compact(['kabupaten']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'kabupaten' => 'required',
        ]);

        $kabupaten = Kabupaten::find($id);

        $kabupaten->update([
            'kabupaten' => $request->kabupaten,
        ]);

        return redirect()->route('kabupaten.index');
    }

    public function destroy($id){
        $kabupaten = Kabupaten::destroy($id);

        return redirect()->route('kabupaten.index');
    }
}
