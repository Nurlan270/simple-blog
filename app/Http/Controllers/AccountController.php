<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function index()
    {
        $name = Auth::user()->name;

        return view('account.panel', compact('name'));
    }

    public function updateName(Request $request)
    {
        if ($request->isMethod('PATCH')) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'min:3', 'max:20']
            ]);

            try {
                User::query()
                    ->where('id', Auth::id())
                    ->update(['name' => $validated['name']]);
            } catch (\Exception $e) {
                $request->session()->flash('error');
                $request->session()->flash('status', 'Something went wrong while updating your name, please try later.');
            }

            $request->session()->flash('status', 'Name was successfully changed !');

            return back();
        } else {
            abort(404);
        }
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('PATCH')) {
            $request->validate([
                'current_password' => ['required', 'string'],
                'new_password'     => ['required', 'string', 'confirmed', Password::min(8)],
            ]);

            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)) {
                $request->session()->flash('error');
                $request->session()->flash('status', "Provided password doesn't match actual one.");

                return back();
            }

            try {
                User::query()
                    ->where('id', $user->id)
                    ->update(['password' => bcrypt($request->new_password)]);
            } catch (\Exception $e) {
                $request->session()->flash('error');
                $request->session()->flash('status', "Something went wrong, please try later.");

                return back();
            }

            $request->session()->flash('status', 'Password changed successfully !');

            return back();
        } else {
            abort(404);
        }
    }

    public function deleteAccount(Request $request)
    {
        if ($request->isMethod('DELETE')) {
            User::query()
                ->where('id', Auth::id())
                ->delete();

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $request->session()->flash('status', 'Your account was deleted successfully !');

            return redirect()->route('home');
        } else {
            abort(404);
        }
    }
}
