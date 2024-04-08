<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\IUP;
use App\Models\User;


class UserIUPController extends Controller
{
    public function index(){
        $user = auth()->user();
        // dd($user = auth()->user());
        // dd($user->iup);
        $iup = $user->iup;
        return view('users.iup.index', compact('iup'));
    }



    public function wiup(){
        // $wiup = IUP::where('user_id', 'user_id') -> get();
        // // $wiup = IUP::where('tahapanKegiatan', 'WIUP')->get();
        // $user = auth()->user();
        // // dd($user = auth()->user());
        // // dd($user->iup);
        // $wiup = $user->iup;

        // $user = auth()->user();

        // // dd($user = auth()->user());

        // $wiupUser = IUP::whereHas('user', function ($query) use ($user) {
        //     $query->where('id', $user->id);
        // })->get();

        // $wiup = $user->wiupUser;

        $user = auth()->user();

        // Menampilkan data IUP berdasarkan user dan tahap kegiatan WIUP
        $wiup = $user->iup()->where('tahapanKegiatan', 'WIUP')->get();

        // return view('users.iup.index', compact('iup'));

        return view('users.iup.wiup.index', compact(['wiup']));
    }


    public function eksplor(){
        // $userData = auth()->user();
        // $eksplor = IUP::where('tahapanKegiatan', 'IUP Tahap Eksplorasi')->get();

        $user = auth()->user();

        // Menampilkan data IUP berdasarkan user dan tahap kegiatan WIUP
        $eksplor = $user->iup()->where('tahapanKegiatan', 'IUP Tahap Eksplorasi')->get();

        // return view('users.iup.index', compact('iup'));

        return view('users.iup.eksplor.index', compact(['eksplor']));
    }

    public function op(){
        // $userData = auth()->user();
        // $op = IUP::where('tahapanKegiatan', 'IUP Tahap Operasi Produksi')->get();

        $user = auth()->user();

        // Menampilkan data IUP berdasarkan user dan tahap kegiatan WIUP
        $op = $user->iup()->where('tahapanKegiatan', 'IUP Tahap Operasi Produksi')->get();

        return view('users.iup.op.index', compact(['op']));
    }

    public function p1(){
        // $userData = auth()->user();
        // $p1 = IUP::where('tahapanKegiatan', 'Perpanjangan 1 IUP Tahap Operasi Produksi')->get();

        $user = auth()->user();

        // Menampilkan data IUP berdasarkan user dan tahap kegiatan WIUP
        $p1 = $user->iup()->where('tahapanKegiatan', 'Perpanjangan 1 IUP Tahap Operasi Produksi')->get();

        return view('users.iup.p1.index', compact(['p1']));
    }

    public function p2(){
        // $userData = auth()->user();
        // $p2 = IUP::where('tahapanKegiatan', 'Perpanjangan 2 IUP Tahap Operasi Produksi')->get();

        $user = auth()->user();

        // Menampilkan data IUP berdasarkan user dan tahap kegiatan WIUP
        $p2 = $user->iup()->where('tahapanKegiatan', 'Perpanjangan 2 IUP Tahap Operasi Produksi')->get();

        return view('users.iup.p2.index', compact(['p2']));
    }
}
