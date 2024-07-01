<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        return view('auth.register');
    }

    public function store(Request $request, StoreRegisterRequest $store_request)
    {
        $validated = $store_request->validated();

        $user = User::query()->create($validated);

        Auth::login($user);

        $request->session()->regenerate();

        $request->session()->flash('auth', "We're glad to see you in our community, " . Auth::user()->name . ' !');

        return redirect()->route('home');
    }
}
