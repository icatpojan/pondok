<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        $admin_permissions = [
            'crud role',
            'crud permission',
        ];

        $guru_permissions = [
            'crud user',
            'crud service',
            'crud order',
        ];

        $murid_permissions = [
        'crud user',
        'crud service',
        'crud order',
        ];

        $permissions = collect($guru_permissions)
            ->merge($admin_permissions)
            ->all();

        $permissions = collect($permissions)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });
        Permission::insert($permissions->toArray());

        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ])->givePermissionTo(Permission::all());

        Role::create([
            'name' => 'guru',
            'guard_name' => 'web'
        ])->givePermissionTo($guru_permissions);

        Role::create([
            'name' => 'murid',
            'guard_name' => 'web'
        ])->givePermissionTo($murid_permissions);
    }
}
