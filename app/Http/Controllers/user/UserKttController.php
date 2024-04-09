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
        $user = auth()->user();
        // $ktt = KTT::where('id', 2)->get();
        // $ktt = KTT::where('user_id', $user->id)->get();
        // dd($user->id);
        $ktt = KTT::where('user_id', auth()->user()->id)->get();
        // $ktt = KTT::whereNotNull('user_id')->count();
        // dd(KTT::where('user_id', $user->id)->get());
        // dd($ktt);
        return view('users.ktt.index', compact(['ktt']));
    }
}
