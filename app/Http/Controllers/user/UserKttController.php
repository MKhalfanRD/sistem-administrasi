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

        return view('users.ktt.index', compact(['ktt']));
    }
}
