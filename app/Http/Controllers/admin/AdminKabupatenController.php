<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class AdminKabupatenController extends Controller
{
    public function index(){
        $kabupaten = Kabupaten::all();
        return view('admin.kabupaten.index', compact(['kabupaten']));
    }

    public function create(){
        return view('admin.kabupaten.create');
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

        return redirect()->route('admin.kabupaten.index')
        ->with('success', 'Data berhasil disimpan')
        ->with('delay', 1500);
    }

    public function edit($id){
        $kabupaten = Kabupaten::findOrFail($id);

        return view('admin.kabupaten.edit', compact(['kabupaten']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'kabupaten' => 'required',
        ]);

        $kabupaten = Kabupaten::find($id);

        $kabupaten->update([
            'kabupaten' => $request->kabupaten,
        ]);

        return redirect()->route('admin.kabupaten.index');
    }

    public function destroy($id){
        $kabupaten = Kabupaten::destroy($id);

        return redirect()->route('admin.kabupaten.index');
    }
}
