<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cadangan;
use App\Models\Komoditas;
use App\Models\User;
use Illuminate\Http\Request;

class UserCadanganController extends Controller
{
    public function index(){
        $user = auth()->user();
        $cadangan = Cadangan::where('user_id', auth()->user()->id)->get();
        return view('users.cadangan.index', compact(['cadangan']));
    }

}
