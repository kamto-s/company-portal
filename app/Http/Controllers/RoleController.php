<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return view('backend.roles.index');
    }

    public function create()
    {
        $permissions = Permission::all();

        $groupedPermissions = $permissions->groupBy('group_name');

        $groupedPermissions = $groupedPermissions->sortKeys();

        return view('backend.roles.create', compact('groupedPermissions'));
    }
}
