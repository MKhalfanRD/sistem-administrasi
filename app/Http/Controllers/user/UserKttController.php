<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Storage;
use App\Models\KTT;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserKttController extends Controller
{
    public function index(){
        $ktt = KTT::all();

        return view('ktt.index', compact(['ktt']));
    }

    public function create(){
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

        return view('ktt.create', compact(['perusahaanUser', 'bulan', 'tahun']));
    }

    public function edit($id){
        $ktt = KTT::find($id);

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

        return view('ktt.edit', compact(['ktt' ,'perusahaanUser', 'bulan', 'tahun']));
    }

    public function store(Request $request)
{
    session()->flashInput($request->input());
    $request->validate([
        'namaPerusahaan' => 'required',
        'namaKtt' => 'required',
        'statusKTT' => 'nullable',
        'noSK' => 'required',
        'bulan' => 'required',
        'tahun' => 'required',
        'fileUpload' => 'nullable|file|mimes:pdf',
    ]);

    $fileUpload = request()->file('fileUpload');
    $filepath = $fileUpload ? $fileUpload->store('fileUpload', 'public') : null;

    $namaBulanInggris = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    // Mendapatkan inputan bulan dan tahun dari request
    $namaBulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    // Mengonversi nama bulan menjadi nilai bulan dalam rentang 1-12
    $bulanIndex = array_search($namaBulan, $namaBulanInggris);
    if ($bulanIndex === false) {
        return redirect()->back()->with('error', 'Nama bulan tidak valid.');
    }

    // Mengonversi bulan dan tahun menjadi objek Carbon
    $tanggalInput = Carbon::createFromDate($tahun, $bulanIndex + 1, 1);

    // Mendapatkan tanggal saat ini
    $tanggalSekarang = Carbon::now();

    // Menentukan statusKTT berdasarkan perbandingan tanggalInput dengan tanggalSekarang
    if ($tanggalInput->year < $tanggalSekarang->year || ($tanggalInput->year == $tanggalSekarang->year && $tanggalInput->month <= $tanggalSekarang->month)) {
        $statusKTT = 'Aktif';
    } else {
        $statusKTT = 'Tidak Aktif';
    }

    $kttData = $request->except('fileUpload');
    $kttData['statusKTT'] = $statusKTT;
    $kttData['fileUpload'] = $filepath;

    $ktt = KTT::create($kttData);
    dd($ktt);

    // Redirect with success message
    return redirect()->route('ktt.index')->with('success', 'KTT berhasil dibuat.');
}


    public function update(Request $request, $id){
        $request->validate([
            'namaPerusahaan' => 'required',
            'namaKtt' => 'required',
            'statusKTT' => 'nullable',
            'noSK' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'fileUpload' => 'nullable|file|mimes:pdf',
        ]);

        $ktt = KTT::find($id);

        $fileUpload = request()->file('fileUpload');
        $filepath = $fileUpload ? $fileUpload->store('fileUpload', 'public') : null;

        $namaBulanInggris = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Mendapatkan inputan bulan dan tahun dari request
        $namaBulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Mengonversi nama bulan menjadi nilai bulan dalam rentang 1-12
        $bulanIndex = array_search($namaBulan, $namaBulanInggris);
        if ($bulanIndex === false) {
            return redirect()->back()->with('error', 'Nama bulan tidak valid.');
        }

        // Mengonversi bulan dan tahun menjadi objek Carbon
        $tanggalInput = Carbon::createFromDate($tahun, $bulanIndex + 1, 1);

        // Mendapatkan tanggal saat ini
        $tanggalSekarang = Carbon::now();

        // Menentukan statusKTT berdasarkan perbandingan tanggalInput dengan tanggalSekarang
        if ($tanggalInput->year < $tanggalSekarang->year || ($tanggalInput->year == $tanggalSekarang->year && $tanggalInput->month <= $tanggalSekarang->month)) {
            $statusKTT = 'Aktif';
        } else {
            $statusKTT = 'Tidak Aktif';
        }

        $kttData = $request->except('fileUpload');

        $kttData['statusKTT'] = $statusKTT;
        $kttData['fileUpload'] = $filepath;

        $ktt->update($kttData);
        dd($ktt);

        return redirect()->route('ktt.index');
    }

    public function destroy($id){
        $ktt = KTT::find($id);

        if (!is_null($ktt->fileUpload)) {
            Storage::disk('public')->delete($ktt->fileUpload);
        }

        return redirect()->route('ktt.index');
    }
}
