<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Storage;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index(){
        $userData = auth()->user();
        return view('users/user.index', compact(['userData']));
    }

    public function edit($id){
        $userData = User::find($id);
        return view('users/user.edit', compact(['userData']));
    }

    public function update(Request $request, $id){
        $request->validate([
            'namaUser' => 'required',
            'namaPerusahaan' => 'required',
            'email' => 'required',
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
            'password'=>$request->password,
            'logo'=> $filepath,
        ]);

        return redirect()->route('user.index');
    }

    public function destroy($id){
        $user = User::find($id);
        if (!is_null($user->logo)) {
            Storage::disk('public')->delete($user->logo);
        }
        $user->delete();

        return redirect()->route('user.index');
    }

}
