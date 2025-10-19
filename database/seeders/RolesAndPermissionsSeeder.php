<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Clear cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'dashboard.view',
            'index.view',
            'index.edit',
            'index.delete',
            'form.submit',
            'users.view',
            'users.edit',
            'users.delete',
            'roles.view',
            'roles.edit',
            'roles.delete',
        ];

        // Create permissions
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions($permissions); // Admin gets all permissions

        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $manager->syncPermissions([
            'dashboard.view',
            'users.view',
            'users.edit',
            'index.view',
        ]);

        $programmer = Role::firstOrCreate(['name' => 'Programmer']);
        $programmer->syncPermissions([
            'dashboard.view',
            'index.view',
            'form.submit',
        ]);

        $demoUser = Role::firstOrCreate(['name' => 'Demo User']);
        $demoUser->syncPermissions([
            'form.submit',
        ]);
    }
}
