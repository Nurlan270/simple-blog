<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->latest()
            ->paginate(30, ['id', 'role', 'name', 'email', 'created_at']);

        return view('admin.users.index', compact('users'));
    }

    public function create(Request $request)
    {
        return view('admin.users.create');
    }

    public function store(Request $request, StoreUserRequest $storeUserRequest)
    {
        $validated = $storeUserRequest->validated();

        User::query()->create($validated);

        return redirect()->route('admin.users.index')
            ->withInput(['success' => 'User created']);
    }

    public function edit(User $user, Request $request)
    {
        $user = User::query()
            ->where('id', $user->id)
            ->first(['id', 'name', 'email', 'role']);

        return view('admin.users.edit', compact('user'));
    }

    public function update(User $user, Request $request, UpdateUserRequest $updateUserRequest)
    {
        $validated = $updateUserRequest->validated();

        $user = User::query()->find($user->id);

        $user->update([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']) ?? $user->password,
            'role'     => $validated['role'] ?? $user->role,
        ]);

        return back()->withInput(['success' => 'User information updated']);
    }

    public function delete_one_user(User $user, Request $request)
    {
        User::query()
            ->find($user->id)
            ->delete();

        return back()->withInput(['success' => 'User deleted']);
    }

    public function delete_selected_users(Request $request)
    {
        $selections = $request->validate([
            'selections' => ['nullable', 'array']
        ]);

        if ($selections = array_values($selections)[0] ?? null) {
            User::query()->whereIn('id', $selections)->delete();

            return back()->withInput(['success' => 'Users deleted']);
        } else {
            return back()->withInput(['error' => "You didn't selected any users to delete"]);
        };
    }
}
