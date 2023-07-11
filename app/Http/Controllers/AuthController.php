<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login()
    {
        if (Auth::check() == true) {

            //arahkan ke routing dashboard
            return redirect('/dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function loginproses(Request $request)
    {
        $credentials = $request->validate([
            'id_pos' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('id_pos', $request->id_pos)->first();

        session([
            'id_pos' => $user->id_pos,
            'nama' => $user->nama,
            'jabatan' => $user->jabatan,
            'level' => $user->level,
            'divisi' => $user->divisi
        ]);

        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     return redirect('/login')->with('errors', 'Password yang anda masukkan salah');
        // }
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Anda Berhasil Login');
        } else {
            return redirect('/login')->with('errors', 'Username atau password yang Anda masukkan salah');
        }
    }



    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     return redirect('/login')->with('success', 'Anda Berhasil Logout');
    // }

    public function logout () {
        // menghapus session yang login
        auth()->logout();

        // arahkan ke routing yang namanya login
        return redirect('login')->with('success', 'Anda Berhasil Logout');
    }
}
