<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\IUP;
use App\Models\User;


class UserIUPController extends Controller
{
    public function index(){
        $iup = User::with('iups')->find(auth()->id());

        return view('users.iup.index', compact('iup'));
    }

    public function wiup(){
        $userData = auth()->user();
        $wiup = IUP::where('tahapanKegiatan', 'WIUP')->get();

        return view('users.iup.wiup.index', compact(['userData','wiup']));
    }


    public function eksplor(){
        $userData = auth()->user();
        $eksplor = IUP::where('tahapanKegiatan', 'IUP Tahap Eksplorasi')->get();

        return view('users.iup.eksplor.index', compact(['userData','eksplor']));
    }

    public function op(){
        $userData = auth()->user();
        $op = IUP::where('tahapanKegiatan', 'IUP Tahap Operasi Produksi')->get();

        return view('users.iup.op.index', compact(['userData','op']));
    }

    public function p1(){
        $userData = auth()->user();
        $p1 = IUP::where('tahapanKegiatan', 'Perpanjangan 1 IUP Tahap Operasi Produksi')->get();

        return view('users.iup.p1.index', compact(['userData','p1']));
    }

    public function p2(){
        $userData = auth()->user();
        $p2 = IUP::where('tahapanKegiatan', 'Perpanjangan 2 IUP Tahap Operasi Produksi')->get();

        return view('users.iup.p2.index', compact(['userData','p2']));
    }
}
