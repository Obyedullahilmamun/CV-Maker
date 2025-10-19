<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return view('pages.roles', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::all();
        return view('pages.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            // 'permissions' => 'nullable|array',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',

        ]);

        $role = Role::create(['name' => $request->name]);

        $permissionIds = $request->input('permissions', []);
        $permissions = Permission::whereIn('id', $permissionIds)->get();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }


    public function edit($id)
    {
        $role = Role::findById($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('pages.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }


    public function update(Request $request, $id)
    {
        $role = Role::findById($id);
        $role->name = $request->input('name');
        $role->save();

        $permissionIds = $request->input('permission', []);
        $permissions = Permission::whereIn('id', $permissionIds)->get(); // Convert IDs to models
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }


    public function show($id)
    {
        $role = Role::findById($id);
        $permissions = $role->permissions;

        return view('pages.roles_show', compact('role', 'permissions'));
    }
}
