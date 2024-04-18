<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\rawInventori;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserRawInventoryController extends Controller
{
    public function index(){
        $user = auth()->user();
        $rawInventori = rawInventori::where('user_id', auth()->user()->id)->get();

        return view('users.rawInventori.index', compact(['rawInventori']));
    }

    public function edit($id){
        $rawInventori = rawInventori::find($id);
        $perusahaanUser = User::whereNotNull('namaPerusahaan')->pluck('namaPerusahaan', 'id');
        $startBulan = Carbon::now()->startOfYear()->locale('id_ID');
        $bulan = [];

        for ($i = 0; $i < 12; $i++) {
            $bulan[] = $startBulan->formatLocalized('%B');
            $startBulan->addMonths(1);
        }

        $startTahun = 2010;
        $endTahun = Carbon::now()->year;
        $tahun = [];

        for ($i = $startTahun; $i <= $endTahun; $i++) {
            $tahun[$i] = $i;
        }

        return view('users.rawInventori.edit', compact(['rawInventori' ,'perusahaanUser', 'bulan', 'tahun']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'namaPerusahaan' => 'required',
            'volumeRawInventori' => 'nullable',
            'tonaseRawInventori' => 'nullable',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $rawInvetori = rawInventori::find($id);
        $rawInvetoriData = $request->all();

        $user = User::where('namaPerusahaan', $request->namaPerusahaan)->first();

        if ($user) {
            $rawInvetoriData['user_id'] = $user->id;
        }

        $rawInvetori->update($rawInvetoriData);

        // dd($rawInvetori);
        return redirect()->route('user.rawInventori.index');
    }
}
