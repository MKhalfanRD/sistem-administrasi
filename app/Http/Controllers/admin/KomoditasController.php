<?php

namespace App\Http\Controllers;

use App\Models\Komoditas;
use Illuminate\Http\Request;

class KomoditasController extends Controller
{
    public function index(){
        $komoditas = Komoditas::all();
        return view('admin.komoditas.index', compact(['komoditas']));
    }

    public function create(){
        $golongan = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        return view('admin.komoditas.create', compact(['golongan']));
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
        $komoditas = Komoditas::findOrFail($id);
        $golongan = [
            'Batuan' => 'Batuan',
            'Mineral Bukan Logam' => 'Mineral Bukan Logam',
            'Mineral Bukan Logam Jenis Tertentu' => 'Mineral Bukan Logam Jenis Tertentu',
        ];
        $golonganSelected = $komoditas->golongan;

        $oldInputs = [];

        if($komoditas){
            $komoditasArray = explode(', ', $komoditas->komoditas);
            foreach($komoditasArray as $komoditasValue){
                $oldInputs[] = ['komoditas' => $komoditasValue];
            }
        }

        return view('admin.komoditas.edit', compact(['komoditas', 'golongan', 'golonganSelected', 'oldInputs']));
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'golongan' => 'required',
            'inputs' => 'required|array',
            'inputs.*.komoditas' => 'nullable',
        ]);

        $komoditas = Komoditas::findOrFail($id);

        // Decode existing komoditas from JSON
        $existingKomoditas = json_decode($komoditas->komoditas, true) ?? [];

        // Handle deleted items
        $deletedItems = $request->input('deletedItems');
        if(!empty($deletedItems)){
            foreach($deletedItems as $deletedItemId){
                unset($existingKomoditas[$deletedItemId]);
            }
        }

        // Add new items
        $newKomoditas = $request->input('inputs.*.komoditas');
        if (!empty($newKomoditas)) {
            foreach ($newKomoditas as $newItem) {
                if (!empty($newItem)) {
                    $existingKomoditas[] = $newItem;
                }
            }
        }

        // Filter out empty values
        $existingKomoditas = array_filter($existingKomoditas, function($value) {
            return $value !== null && $value !== '';
        });

        // Remove duplicates
        $existingKomoditas = array_unique($existingKomoditas);

        // Convert array to string
        $komoditas->komoditas = implode(', ', $existingKomoditas);

        $komoditas->save();

        return redirect()->route('komoditas.index');
    }

    public function destroy($id){
        $komoditas = Komoditas::find($id);
        $komoditas->delete();

        return redirect()->route('komoditas.index');
    }
}
