<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $data['page'] = 'login';
        $data['title'] = config('app.name');
        return view('mods.auth.index', compact('data'));
    }
    
    public function register()
    {
        $data['page'] = 'register';
        $data['title'] = "Form Registrasi";
        return view('mods.auth.index', compact('data'));
    }

    public function forgot()
    {
        $data['page'] = 'forgot';
        $data['title'] = "Forgot Password";
        return view('mods.auth.index', compact('data'));
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('auth.login');
    }

    

    
}
