<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'Superadmin', 'guard_name' => 'web']);

        $permissionsAll = [
            [
                'group_name' => 'Role',
                'permissions' => [
                    'role.permission',
                    'role.list',
                    'role.create',
                    'role.edit',
                    'role.delete',
                ]
            ],
            [
                'group_name' => 'Category',
                'permissions' => [
                    'category.permission',
                    'category.list',
                    'category.create',
                    'category.edit',
                    'category.delete',
                ]
            ],
            [
                'group_name' => 'Post',
                'permissions' => [
                    'post.permission',
                    'post.list',
                    'post.create',
                    'post.edit',
                    'post.delete',
                ]
            ]
        ];

        foreach ($permissionsAll as $permGroup) {
            $permissionGroup = $permGroup['group_name'];

            foreach ($permGroup['permissions'] as $permissionName) {
                $permission = Permission::create([
                    'name' => $permissionName,
                    'group_name' => $permissionGroup,
                    'guard_name' => 'web'
                ]);

                $role->givePermissionTo($permission);
                $permission->assignRole($role);
            }
        }

        $user = User::find(1);
        if ($user) {
            $user->assignRole($role);
        }
    }
}
