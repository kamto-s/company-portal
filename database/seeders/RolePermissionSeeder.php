<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
                'group_name' => 'Category',
                'permissions' => [
                    'category.permission',
                    'category.list',
                    'category.create',
                    'category.edit',
                    'category.delete',
                ]
            ]
        ];
    }
}
