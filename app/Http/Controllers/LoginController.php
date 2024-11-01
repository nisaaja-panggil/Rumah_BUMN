<?php

namespace App\Http\Controllers;
use illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function loginView(){
        return view('login');
    }
    public function authenticate(request $request):RedirectResponse{
        $credebtials=$request->validate([
            'email'=>['required','email:rfc,dns'],
            'password'=>['required'],
        ]);
        if (Auth::attempt($credebtials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->with('loginError','Login Failed');
    }
    public function logout(request $request):RedirectResponse{
        auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
