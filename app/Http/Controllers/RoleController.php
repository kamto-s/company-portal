<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('backend.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        $groupedPermissions = $permissions->groupBy('group_name');

        $groupedPermissions = $groupedPermissions->sortKeys();

        return view('backend.roles.create', compact('groupedPermissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|max:255|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->role_name
        ]);

        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with(['message' => 'Role created successfully']);
    }

    public function edit($id)
    {
        $groupedPermissions = Permission::all()->groupBy('group_name')->sortKeys();

        $role = Role::findById($id);

        $rolePermissions = $role->permissions()->pluck('name')->toArray();

        return view('backend.roles.edit', compact('groupedPermissions', 'role', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required|max:255|unique:roles,name,' . $id,
        ]);

        Role::where('id', $id)->update([
            'name' => $request->role_name
        ]);

        $role = Role::findById($id);

        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with(['message' => 'Role updated successfully']);
    }

    public function delete($id)
    {
        if ($id) {
            $role = Role::findById($id);

            if (!is_null($role)) {
                $role->delete();
            }
        }

        return redirect()->route('roles.index')->with(['message' => 'Role deleted successfully']);
    }
}
