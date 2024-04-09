<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Storage;
use App\Models\Jampas;
use App\Models\User;
use Illuminate\Http\Request;

class UserJampasController extends Controller
{
    public function index()
    {
        $user= auth()->user();
        $jampas = Jampas::where('user_id', auth()->user()->id)->get();
        // dd($user->jampas);
        // $jampas = $user->jampas;
        return view('users.jampas.index', compact(['jampas']));
    }
}
