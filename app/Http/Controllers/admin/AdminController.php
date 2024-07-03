<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        $userData = User::all();
        // dd($userData);
        return view('admin.user.index', compact(['userData']));
    }

    public function create(){
        return view('admin.user.create');
    }

    public function store(Request $request){
        session()->flashInput($request->input());
        $request->validate([
            'namaUser' => 'required',
            'namaPerusahaan' => 'nullable',
            'email' => 'required|email',
            'wa' => 'required|string|max:15',
            'password' => 'required',
            'logo' => 'nullable|mimes:jpg,jpeg,png',
        ]);

        $password = bcrypt($request->input('password'));

        $logo = request()->file('logo');
        if($logo){
            $filepath = $logo->store('logo', 'public');
        }else{
            $filepath = null;
        }

        $userData = User::create([
            'namaUser'=>$request->namaUser,
            'namaPerusahaan'=>$request->namaPerusahaan,
            'email'=>$request->email,
            'wa' =>$request->wa,
            'password'=>$password,
            'logo'=> $filepath,
        ]);

        // dd($userData);

        return redirect()->route('admin.index');
    }

    public function edit($id){
        $userData = User::find($id);
        return view('admin.user.edit', compact(['userData']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'namaUser' => 'required',
            'namaPerusahaan' => 'required',
            'email' => 'required',
            'wa' => 'required|string|max:15',
            'password' => 'required',
            'logo' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        $userData = User::find($id);
        $logo = $request->file('logo');
        $filepath = $request->hasFile('logo') ? $logo->store('scanSK', 'public') : $userData->logo ?? null;

        if ($request->hasFile('logo')) {
            $oldLogo = $userData->logo;

            if($oldLogo){
                Storage::disk('public')->delete($oldLogo);
            }
            $logo = request()->file('logo');
            $filepath = $logo->store('logo', 'public');
        }
        else {
            $filepath = $userData->logo;
        }

        $userData->update([
            'namaUser'=>$request->namaUser,
            'namaPerusahaan'=>$request->namaPerusahaan,
            'email'=>$request->email,
            'wa' =>$request->wa,
            'password'=>$request->password,
            'logo'=> $filepath,
        ]);
        // dd($userData);
        return redirect()->route('admin.index');
    }

    public function destroy($id){
        $user = User::find($id);
        if (!is_null($user->logo)) {
            Storage::disk('public')->delete($user->logo);
        }
        $user->delete();

        return redirect()->route('admin.index');
    }
}
