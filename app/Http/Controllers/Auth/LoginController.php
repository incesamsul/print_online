<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }

    public function registrasi()
    {
        return view('auth.registrasi');
    }

    public function postRegistrasi(Request $request)
    {
        $emailCek = User::where('email', '=', $request->email)->first();

        if ($emailCek) {
            return redirect('/registrasi')->with('fail', 'email sudah terdaftar');
        }

        if ($request->password != $request->konfirmasi_password) {
            return redirect('/registrasi')->with('fail', 'password tdk match');
        }
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ]);

        return redirect('/registrasi')->with('message', 'registrasi berhasil di lakukan');
    }


    public function postLogin(Request $request)
    {
        $user = User::where('email', $request->email)
            ->first();


        if ($user) {
            if (password_verify($request->password, $user->password)) {

                Auth::login($user);
                if ($user->role == 'user') {
                    return redirect('/');
                }
                return redirect('/dashboard');
            } else {
                return redirect('/login')->with('fail', 'Password yang anda masukan salah');
            }
        } else {
            return redirect('/login')->with('fail', 'Username yang anda masukan salah');
        }
        // if (Auth::attempt($request->only('username', 'password'))) {
        //     return redirect('/kasir');
        // }
        // return redirect('/login-biasa')->with('fail', 'Username atau password anda salah');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
