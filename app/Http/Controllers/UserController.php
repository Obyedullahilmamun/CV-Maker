<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        $roles = Role::all();
        return view('pages.users', compact('users', 'roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('pages.users_edit', compact('user', 'roles', 'userRoles'));
    }

    public function show(User $user)
    {
        return view('pages.users_show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'nullable|array',
        ]);

        if ($request->roles) {
            $user->syncRoles($request->roles);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('users.index')->with('success', 'User roles updated successfully.');
    }
}
