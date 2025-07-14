<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view ('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password'=> 'required'
        ],[
            'email.required' => 'Email harus diisi',
            'email.email'=> 'format email tidak valid',
            'password.required' => 'password harus diisi'
        ]);

        if(Auth::attempt($credential))
        {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Login Berhasil');
        }
        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->onlyInput('email');
    }

    public function logout (Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
