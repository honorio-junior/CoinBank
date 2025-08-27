<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use App\UserStatus;

class LoginController extends Controller
{
    public function showView()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            //
            if (Auth::user()->status == UserStatus::Approved->value) {
                $request->session()->regenerate();
                return redirect()->route('home');
            }elseif (Auth::user()->status == UserStatus::AwaitingApproval->value) {
                //
                Auth::logout();
                return redirect()->back()->with('awaiting' , 'Your registration is awaiting approval.');
            }else{
                //
                Auth::logout();
                return redirect()->back()->with('denied', 'Your registration has been denied.');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
