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
}
