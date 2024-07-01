<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create(Request $request)
    {
        return view('auth.login');
    }

    public function authenticate(Request $request, AuthenticateLoginRequest $authenticate_request)
    {
        $validated = $authenticate_request->safe()->only('remember');

        $remember = !! ($validated['remember'] ?? false);

        $credentials = $authenticate_request->safe()->except('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $request->session()->flash('auth', 'Welcome back, ' . Auth::user()->name . ' !');

            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'authError' => __('Email or password is invalid.')
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
