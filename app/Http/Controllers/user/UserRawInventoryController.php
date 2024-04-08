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
        $rawInventori = rawInventori::all();

        return view('users.rawInventori.index', compact(['rawInventori']));
    }
}
