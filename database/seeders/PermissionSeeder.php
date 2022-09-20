<?php

namespace Database\Seeders;

use App\Enum\Permissions;
use App\Enum\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => Roles::ADMIN, 'guard_name' => 'api']);
        $user = Role::create(['name' => Roles::USER, 'guard_name' => 'api']);

        Permission::create(['name' => Permissions::POST_CREATE, 'guard_name' => 'api']);
        Permission::create(['name' => Permissions::POST_DELETE, 'guard_name' => 'api']);
        Permission::create(['name' => Permissions::POST_UPDATE, 'guard_name' => 'api']);
        Permission::create(['name' => Permissions::USER_DELETE, 'guard_name' => 'api']);
        Permission::create(['name' => Permissions::USER_UPDATE, 'guard_name' => 'api']);

        $admin->givePermissionTo(Permissions::POST_CREATE);
        $admin->givePermissionTo(Permissions::POST_DELETE);
        $admin->givePermissionTo(Permissions::POST_UPDATE);
        $admin->givePermissionTo(Permissions::USER_DELETE);
        $admin->givePermissionTo(Permissions::USER_UPDATE);

        $user->givePermissionTo(Permissions::POST_CREATE);
        $user->givePermissionTo(Permissions::POST_DELETE);
        $user->givePermissionTo(Permissions::POST_UPDATE);
    }
}
