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
}
