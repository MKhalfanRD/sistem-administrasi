<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Komoditas;
use App\Models\Produksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserProduksiController extends Controller
{
    public function index(){
        $produksi = Produksi::all();

        return view('users.produksi.index', compact(['produksi']));
    }
}
