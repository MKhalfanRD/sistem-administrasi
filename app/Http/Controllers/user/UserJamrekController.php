<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Storage;
use App\Models\Jamrek;
use App\Models\User;
use Illuminate\Http\Request;

class UserJamrekController extends Controller
{
    public function index()
    {
        $jamrek = Jamrek::all();
        return view('users.jamrek.index', compact(['jamrek']));
    }
}
