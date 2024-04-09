<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Komoditas;
use App\Models\Sumberdaya;
use App\Models\User;
use Illuminate\Http\Request;

class UserSumberdayaController extends Controller
{
    public function index(){
        $user = auth()->user();
        $sumberdaya = Sumberdaya::where('user_id', auth()->user()->id)->get();
        return view('users.sumberdaya.index', compact(['sumberdaya']));
    }
}
