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
        $user = auth()->user();
        // dd($user = auth()->user());
        $jamrek = Jamrek::where('id', auth()->user()->id)->get();
        // $jamrek = $user->jamrek;
        // $jamrek = Jamrek::all();
        // dd($user);
        // dd($user);
        return view('users.jamrek.index', compact(['jamrek']));
    }
}
